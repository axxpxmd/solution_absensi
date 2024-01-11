<?php

namespace App\Http\Controllers;

use DataTables;

use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Http\Request;

// Models
use App\Models\UserDevice;

class UserController extends Controller
{
    public function index()
    {
        $this->getDataUserFromDevice();

        return view('pages.user.index');
    }

    public function getDataUserFromDevice()
    {
        $zk = new ZKTeco('192.168.18.68');
        if ($zk->connect()) {
            $zk->removeUser(5);
            $datas = $zk->getUser();

            $zk->enableDevice();
        }

        // Save data to table user
        foreach ($datas as $i) {
            UserDevice::updateOrCreate([
                'uid' => $i['uid'],
                'user_id' => $i['userid'],
                'nama' => $i['name'],
                'role' => $i['role'],
                'password' => $i['password'],
                'card_no' => $i['cardno']
            ]);
        }

        $zk->disconnect();

        return response()->json([
            'status' => true
        ]);
    }

    public function dataTable()
    {
        $data = UserDevice::select('id', 'uid', 'user_id', 'nama', 'role', 'password', 'card_no')->orderBy('id', 'DESC')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                //
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('pages.user.add');
    }
}
