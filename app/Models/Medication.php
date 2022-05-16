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
        'made_in ',
        'quntity',
        'photo',
        'user_id',
        'categorie_id ',
        'production_date ',
         'expiry_date',
         'active',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at','updatet_at',
    ];

    public function getActive()
    {

        return $this->active == 1 ? 'متوفر'  : 'غير متوفر';
    }

    public function scopeActive($qury)
    {

        return $qury->where('active', 1);
    }
    
    public function scopeSelection($qury)
    {
        return $qury->select('id',  'trade_name','scientific_name', 'made_in ','quntity','photo','production_date ','expiry_date');
    }




}
