<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    protected $table = 'user_device';
    protected $fillable = ['id', 'uid', 'user_id', 'name', 'role', 'password', 'card_no'];
}
