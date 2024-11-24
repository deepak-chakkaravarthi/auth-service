<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles relationship.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Assign role to the user.
     */
    public function assignRole($role)
    {
        return $this->roles()->sync($role);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }
}
