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
        'photo',
        'statuse',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at'
    ];
    
    

    public function getActive()
    {

        return $this->statuse == 1 ? 'مفعل'  : 'غير مفعل';
    }
    
    public function scopeActive($qury)
    {

        return $qury->where('statuse', 1);
    }
    
    public function scopeSelection($qury)
    {
        return $qury->select('id',  'name', 'photo', 'statuse');
    }


    



}
