<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
          'name', 'street', 'street_number', 'postal_code', 'country', 'vat_number', 'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
