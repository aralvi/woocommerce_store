<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
     public function User()
    {
        return $this->belongsTo(User::class);
    }
}
