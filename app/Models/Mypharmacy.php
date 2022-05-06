<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mypharmacy extends Model
{
    use HasFactory;

    protected $table='mypharmacys';

    protected $fillable = [
        'id',
        'name',
        'social_media',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at'
    ];

}
