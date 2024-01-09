<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Rats\Zkteco\Lib\ZKTeco;

class AbsenController extends Controller
{
    public function index()
    {
        $zk = new ZKTeco('192.168.1.201');
        if ($zk->connect()) {
            $datas = $zk->getAttendance();

            $zk->enableDevice();
        }

        $zk->disconnect();
        return view('pages.absen.index', compact(
            'datas'
        ));
    }
}
