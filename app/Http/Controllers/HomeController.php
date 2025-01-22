<?php

namespace App\Http\Controllers;

use App\Http\Services\Fingerprint;
use App\Models\Device;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;

class HomeController extends Controller
{
    protected $fingerprint;

    public function __construct(Fingerprint $fingerprint)
    {
        $this->fingerprint = $fingerprint;

        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $devices = $this->fingerprint->checkConnection();

        return view('welcome', compact(
            'devices'
        ));
    }

    public function hitMe($id)
    {
        $device = Device::find($id);

        $zk = new ZKTeco($device->ip);
        if ($zk->connect()) {
            $zk->testVoice();

            $zk->enableDevice();
        }
        $zk->disconnect();

        return ['message' => 'berhasil'];
    }
}
