<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationMypharmacy extends Model
{
    use HasFactory;
    protected $table='medication_mypharmacys';


    protected $fillable = [
        'id',
        'mypharmacy_id',
        'mypharmacy_id ',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at','mypharmacy_id','mypharmacy_id'
    ];


}
