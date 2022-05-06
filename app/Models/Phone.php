<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table='phones';

    protected $fillable = [
        'id',
        'mypharmacy_id',
        'phone_number',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['created_at','updatet_at'];
}
