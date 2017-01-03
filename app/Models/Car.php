<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'licence_plate', 'user_id'
    ];

    public function route()
    {
        return $this->hasMany('App\Models\Route');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
