<?php

namespace App\Http\Services;

use Rats\Zkteco\Lib\ZKTeco;

// Models
use App\Models\Device;

class Fingerprint
{
    // check connection to device
    public static function checkConnection()
    {
        // get all data device
        $devices = Device::select('ip', 'status', 'ket', 'id')->get();

        $dataDevices = [];
        foreach ($devices as $key => $d) {
            // check status device
            if ($d->status == 1) {
                // connect to device
                $zk = new ZKTeco($d->ip);

                // check connection
                $status = false;
                $version = '-';
                $osVersion = '-';
                $platform = '-';
                $firmwareVersion = '-';
                $serialNumber = '-';
                $deviceName = '-';
                $deviceTime = '-';
                if ($zk->connect()) {
                    $status = true;
                    $version = $zk->version();
                    $osVersion = $zk->osVersion();
                    $platform = $zk->platform();
                    $firmwareVersion = $zk->fmVersion();
                    $serialNumber = $zk->serialNumber();
                    $deviceName = $zk->deviceName();
                    $deviceTime = $zk->getTime();
                }

                $dataDevices[$key] = [
                    'id' => $d->id,
                    'ip' => $d->ip,
                    'status' => $status,
                    'version' => $version,
                    'osVersion' => $osVersion,
                    'platform' => $platform,
                    'firmwareVersion' => $firmwareVersion,
                    'serialNumber' => $serialNumber,
                    'deviceName' => $deviceName,
                    'deviceTime' => $deviceTime,
                    'ket' => $d->ket
                ];
            }
        }

        return $dataDevices;
    }

    public static function getAttendance($nik)
    {
        // get all data device
        $devices = Device::all();
    }
}
