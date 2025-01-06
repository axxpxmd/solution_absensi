<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{ 
    protected $table = 'kegiatan';
    protected $fillable = ['id', 'nama_kegiatan', 'tanggal_kegiatan', 'tempat_kegiatan', 'keterangan'];
}
