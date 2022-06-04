<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationMypharmacy extends Model
{
    use HasFactory;
    protected $table='mypharmacy_medication';


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
        'created_at',
        'updatet_at',
        
    ];

    public function getActive()
    {

        return $this->status == 1 ?  ' متوفر':'غير متوفر' ;
    }

    public function scopeActive($qury)
    {

        return $qury->where('status', 1);
    }
    public function scopeSelection($qury)
    {
        return $qury->select('id','mypharmacy_id','medication_id','quntity','price','expiry_date', 'production_date','categorie_id');
    }

    // public function medications(){
    //     return $this->belongsToMany(Medication::class,'medication_mypharmacys','medication_id','id');
    // }

    public function category(){
        return $this->belongsTo(Category::class,'categorie_id','id');
      }

}
