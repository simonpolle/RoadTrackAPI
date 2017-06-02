<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'latitude', 'longitude'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
