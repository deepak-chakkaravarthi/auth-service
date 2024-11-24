<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
