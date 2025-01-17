<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenDevice extends Model
{
    protected $table = 'absen_device';
    protected $fillable = ['id', 'uid', 'user_id', 'state', 'timestamp', 'type'];

    public function userDevice()
    {
        return $this->belongsTo(UserDevice::class, 'user_id', 'user_id')->withDefault(['name' => '-']);
    }

    public static function queryData($tanggal, $nama_pegawai, $type)
    {
        return self::select('id', 'uid', 'user_id', 'state', 'timestamp', 'type')
            ->when($tanggal, function($query) use ($tanggal) {
                return $query->whereDate('timestamp', $tanggal);
            })
            ->when($nama_pegawai, function($query) use ($nama_pegawai) {
                return $query->whereHas('userDevice', function($query) use ($nama_pegawai) {
                    return $query->where('name', 'like', '%' . $nama_pegawai . '%');
                });
            })
            ->when($type, function($query) use ($type) {
                return $query->where('type', $type);
            })
            ->orderBy('timestamp', 'desc')
            ->get();
    }
}
