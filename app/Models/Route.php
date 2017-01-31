<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
      'user_id', 'car_id', 'distance_travelled', 'total_cost'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
