<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
      'user_id', 'car_id', 'distance_travelled', 'total_cost'
    ];

    public function car()
    {
        return $this->hasMany('App\Models\Car');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
