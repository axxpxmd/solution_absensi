<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Rats\Zkteco\Lib\ZKTeco;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $zk = new ZKTeco('192.168.62.230');
        if ($zk->connect()) {
            $device_name = $zk->deviceName();
            $device_serial_number = $zk->serialNumber();

            $status_device = true;

            $zk->enableDevice();
        } else {
            $status_device = false;
            $device_name = '-';
            $device_serial_number = '-';
        }

        return view('welcome', compact(
            'device_name',
            'status_device',
            'device_serial_number'
        ));
    }

    public function testPerangkat()
    {
        $zk = new ZKTeco('192.168.62.230');
        if ($zk->connect()) {
            $zk->testVoice();

            $zk->enableDevice();
        }
        $zk->disconnect();


        return ['message' => 'berhasil'];
    }
}
