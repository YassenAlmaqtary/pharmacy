<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table='categories';

    protected $fillable = [
        'id',
        'name',
        'details',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at'
    ];
    


}
