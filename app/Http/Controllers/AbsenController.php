<?php

namespace App\Http\Controllers;

use Rats\Zkteco\Lib\ZKTeco;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\AbsenDevice;

class AbsenController extends Controller
{
    public function index()
    {
        $this->getDataAbsenFromDevice();
        return view('pages.absen.index');
    }

    /**
     * Retrieve attendance data from the ZKTeco device and update the database.
     *
     * This method connects to a ZKTeco device using the provided IP address,
     * retrieves the attendance data, and updates the database with the retrieved data.
     * It uses the `updateOrCreate` method to either update existing records or create new ones.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataAbsenFromDevice()
    {
        $zk = new ZKTeco('192.168.63.196');
        if ($zk->connect()) {
            $datas = $zk->getAttendance();
            $zk->enableDevice();

            foreach ($datas as $data) {
                $check = AbsenDevice::where('user_id', $data['id'])
                    ->whereDate('timestamp', date('Y-m-d', strtotime($data['timestamp'])))
                    ->first();

                if (!$check) {
                    AbsenDevice::create([
                        'uid' => $data['uid'],
                        'user_id' => $data['id'],
                        'state' => $data['state'],
                        'timestamp' => $data['timestamp'],
                        'type' => $data['type']
                    ]);
                }
            }

            $zk->disconnect();
        }

        return response()->json(['status' => true]);
    }

    /**
     * Handles the DataTable request for AbsenDevice data.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     *
     * @return \Yajra\DataTables\DataTableAbstract The DataTable instance with the processed data.
     *
     * The method performs the following operations:
     * - Selects specific columns from the AbsenDevice model.
     * - Applies filters based on the request parameters:
     *   - Filters by date if 'tanggal' is provided.
     *   - Filters by employee name if 'nama_pegawai' is provided.
     *   - Filters by type if 'type' is provided.
     * - Orders the results by the 'timestamp' column in descending order.
     * - Returns the data formatted for DataTables with additional columns:
     *   - 'action': A column with an HTML link for deleting the record.
     *   - 'user_id': The name of the user associated with the device.
     *   - 'state': A human-readable string representing the state (Finger Print or Password).
     *   - 'type': A human-readable string representing the type (Masuk or Pulang).
     * - Adds an index column and marks the 'action' column as containing raw HTML.
     */
    public function dataTable(Request $request)
    {
        $data = AbsenDevice::queryData($request->tanggal, $request->nama_pegawai, $request->type);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' class='text-danger fs-16 m-r-15' title='Hapus Absen' onclick='remove(" . $p->uid . ")'><i class='fa fa-times'></i></a>";
            })
            ->editColumn('user_id', function ($p) {
                return $p->userDevice->name;
            })
            ->editColumn('state', function ($p) {
                return $p->state == 1 ? 'Finger Print' : ($p->state == 0 ? 'Password' : '-');
            })
            ->editColumn('type', function ($p) {
                return $p->type == 0 ? 'Masuk' : ($p->type == 1 ? 'Pulang' : '-');
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
