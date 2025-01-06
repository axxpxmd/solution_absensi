<?php

namespace App\Http\Controllers;

use DataTables;

use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Http\Request;

// Models
use App\Models\AbsenDevice;

class AbsenController extends Controller
{
    public function index()
    {
        $this->getDataAbsenFromDevice();

        return view('pages.absen.index');
    }

    public function getDataAbsenFromDevice()
    {
        $zk = new ZKTeco('192.168.62.23');
        if ($zk->connect()) {
            $datas = $zk->getAttendance();

            $zk->enableDevice();
        }

        // Save data to table user
        foreach ($datas as $i) {
            AbsenDevice::updateOrCreate([
                'uid' => $i['uid'],
                'user_id' => $i['id'],
                'state' => $i['state'],
                'timestamp' => $i['timestamp'],
                'type' => $i['type']
            ]);
        }

        $zk->disconnect();

        return response()->json([
            'status' => true
        ]);
    }

    public function dataTable()
    {
        $data = AbsenDevice::select('id', 'uid', 'user_id', 'state', 'timestamp', 'type')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                $hapus  = "<a href='#' class='text-danger fs-16 m-r-15' title='Hapus Absen' onclick='remove(" . $p->uid . ")' ><i class='fa fa-times'></i></a>";

                return $hapus;
            })
            ->editColumn('user_id', function($p) {
                return $p->userDevice->nama;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
