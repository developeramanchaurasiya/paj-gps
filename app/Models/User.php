<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable,HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }
}

