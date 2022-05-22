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
        'medication_id',
        'user_id',
        'quntity',
        'price',
        'production_date',
        'categorie_id',
        'expiry_date',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at','mypharmacy_id','medication_id'
    ];
    public function getActive()
    {

        return $this->status == 1 ? 'متوفر' : 'غير متوفر';
    }

    public function scopeActive($qury)
    {

        return $qury->where('status', 1);
    }

    public function medications(){
        return $this->belongsToMany(Medication::class,'medication_mypharmacys','mypharmacy_id','id');
    }

}
