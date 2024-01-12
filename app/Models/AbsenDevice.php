<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenDevice extends Model
{
    protected $table = 'absen_device';
    protected $fillable = ['id', 'uid', 'user_id', 'state', 'timestamp', 'type'];

    public function userDevice()
    {
        return $this->belongsTo(UserDevice::class, 'user_id', 'user_id');
    }
}
