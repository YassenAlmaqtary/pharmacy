<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyPharmacy extends Model
{
    use HasFactory;

    protected $table='mypharmacys';

    protected $fillable = [
        'id',
        'name',
        'social_media',
        'address',
        'photo',
         'pdf_path',
         'mobile1',
         'mobile2',
         'user_id',
         'statuse',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at','user_id','pivot'
    ];
    public function scopeActive($qury)
    {
        return $qury->where('statuse', 1);
    }


    public function scopeSelection($qury)
    {
        return $qury->select('id','name','photo','social_media','address','pdf_path','mobile1','mobile2','user_id','statuse');
    }

    public function getActive()
    {
        return $this->statuse == 1 ? 'مفعل'  : 'غير مفعل';
    }
    


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
      }
      
      public function medications(){
        return $this->belongsToMany(Medication::class,'mypharmacy_medication','mypharmacy_id','medication_id');
    }
    

}
