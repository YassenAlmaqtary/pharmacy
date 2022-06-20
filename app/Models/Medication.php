<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
    protected $table='medications';

    protected $fillable = [
        'id',
        'trade_name',
        'scientific_name',
        'made_in',
        'photo',
        'user_id',
        'categorie_id',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at','user_id','pivot'
    ];

    public function getActive()
    {

        return $this->active == 1 ? ' مفعل'  : 'غير مفعل';
    }

    public function scopeActive($qury)
    {
        return $qury->where('active', 1);
    }
    
    public function scopeSelection($qury)
    {
        return $qury->select('id','trade_name','scientific_name', 'made_in','photo');
    }
     
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
      }

    public function Pharmacys(){
        return $this->belongsToMany(MyPharmacy::class,'mypharmacy_medication','medication_id','mypharmacy_id');  
    }   

    


}
