<?php

namespace App;

use App\Models\Car;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'role_id', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
