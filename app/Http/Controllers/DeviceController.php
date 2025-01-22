<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeviceController extends Controller
{
    public function index()
    {
        return view('pages.device.index');
    }

    public function dataTable()
    {
        $data = Device::select('ip', 'ket', 'status')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' class='text-danger fs-16 m-r-15' title='Hapus Absen' onclick='remove(" . $p->id . ")'><i class='fa fa-times'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip' => 'required|unique:device,ip',
            'ket' => 'required'
        ]);

        Device::create($request->all());

        return response()->json(['message' => 'Data berhasil disimpan']);
    }
}
