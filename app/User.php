<?php

namespace App;

use App\Models\Company;
use App\Models\Cost;
use App\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'image', 'role_id', 'cost_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
}
