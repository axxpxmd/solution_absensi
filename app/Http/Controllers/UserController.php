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
        $zk = new ZKTeco('192.168.62.23');
        if ($zk->connect()) {
            $datas = $zk->getUser();
            // dd($datas);

            $zk->enableDevice();
        }

        // Save data to table user
        foreach ($datas as $i) {
            UserDevice::updateOrCreate([
                'uid' => $i['uid'],
                'user_id' => $i['userid'],
                'name' => $i['name'],
                'role' => $i['role'],
                'password' => $i['password'],
                'card_no' => $i['cardno']
            ]);

            $checkData = UserDevice::where('uid', $i['uid'])->get();

            if (count($checkData) > 1) {
                foreach ($checkData as $k) {
                    // check if name not same
                    if($k->name != $i['name']) {
                        UserDevice::where('name', $k->name)->delete();
                    }

                    // check if role not same
                    if($k->role != $i['role']) {
                        UserDevice::where('role', $k->role)->delete();
                    }
                }
            }
        }

        $zk->disconnect();

        return response()->json([
            'status' => true
        ]);
    }

    public function dataTable()
    {
        $data = UserDevice::select('id', 'uid', 'user_id', 'name', 'role', 'password', 'card_no')->orderBy('id', 'DESC')->get();

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
        $getLastId = UserDevice::count() + 1;

        return view('pages.user.add', compact('getLastId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|numeric|unique:user_device,uid',
            'user_id' => 'required|numeric|unique:user_device,user_id',
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

        $zk = new ZKTeco('192.168.62.23');
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
            $zk = new ZKTeco('192.168.62.23');
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
