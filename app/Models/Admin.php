<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User  as Authenticatable;

class Admin extends  Authenticatable
{
    use HasFactory;

    protected $table='admins';
    
    protected $fillable = [
        'name', 'email','photo', 'password','created_at','updated_at'
    ];


    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];
}
