<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
class Store extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
