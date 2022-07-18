<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllterNative extends Model
{
    use HasFactory;

    protected $table='allter_natives';

    protected $fillable = [
        'id',
        'trade_name',
        'scientific_name',
        'made_in',
        'photo',
        'user_id',
        'status',
        'medication_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at','user_id','pivot'
    ];
    public function getStatus()
    {
        return $this->status == 1 ? ' مفعل'  : 'غير مفعل';
    }

    public function scopeStatus($qury)
    {
        return $qury->where('status', 1);
    }
    public function scopeSelection($qury)
    {
        return $qury->select('id','trade_name','status','scientific_name','made_in','photo','medication_id');
    }

    public function medication(){
        return $this->belongsTo(Medication::class,'medication_id','id');
      }

    public function pharmacys(){
        return $this->belongsToMany(MyPharmacy::class,'allter_native_pharmacys','allter_native_id','mypharmacy_id');
    }

}
