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
                $hapus  = "<a href='#' class='text-danger fs-16 m-r-15' title='Hapus Absen' onclick='remove(" . $p->uid . ")' ><i class='fa fa-times'></i></a>";

                return $hapus;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('pages.user.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|numeric',
            'user_id' => 'required|numeric',
            'name' => 'required|max:50',
            'password' => 'required',
            'role' => 'required'
        ]);

        $uid = $request->uid;
        $userid = $request->user_id;
        $name = $request->name;
        $password = $request->password;
        $role = $request->role;
        $cardno = $request->card_no;

        $zk = new ZKTeco('192.168.18.68');
        if ($zk->connect()) {
            $zk->setUser($uid, $userid, $name, $password, $role, $cardno);

            $zk->enableDevice();
        }
        $zk->disconnect();

        return redirect()
            ->route('user.index')
            ->withSuccess('Data berhasil ditambahkan');
    }

    public function delete($uid)
    {
        try {
            // delete from device
            $zk = new ZKTeco('192.168.18.68');
            if ($zk->connect()) {
                $zk->removeUser($uid);

                $zk->enableDevice();
            }

            $zk->disconnect();

            // delete from table
            UserDevice::where('uid', $uid)->delete();

            return response()->json(["message" => "Berhasil Hapus Absen"]);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Gagal Hapus Absen"], 400);
        }
    }
}
