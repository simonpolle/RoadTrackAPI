<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'licence_plate', 'user_id'
    ];

    public function route()
    {
        return $this->hasMany(Route::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
