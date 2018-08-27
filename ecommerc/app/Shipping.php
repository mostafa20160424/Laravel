<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table='shippings';
    protected $fillable=[
        'name_ar',
        'name_en',
        'user_id',
        'lat',
        'lng',
        'logo',
    ];

    public function user_id()
    {
        return $this->hasOne('App\User','id','user_id');
        // $this->hasOne('refrence model','column in refrence model','column in this model');
        
    }
}
