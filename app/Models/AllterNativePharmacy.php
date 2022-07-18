<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllterNativePharmacy extends Model
{
    use HasFactory;
    protected $table='allter_native_pharmacys';


    protected $fillable = [
        'id',
        'allter_native_id',
        'medication_id',
        'user_id',
        'quntity',
        'price',
        'production_date',
        'expiry_date',
        'status',
        'mypharmacy_id', 
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updatet_at',
    ];

    public function getStatus()
    {

        return $this->status == 1 ?  ' متوفر':'غير متوفر' ;
    }

    public function scopeStatus($qury)
    {

        return $qury->where('status', 1);
    }
    public function scopeSelection($qury)
    {
        return $qury->select('id','allter_native_id','quntity','price','expiry_date', 'production_date',);
    }

}
