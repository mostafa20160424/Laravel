<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable=[
      'user_id',
      'news_id',
      'comment',
    ];

    public function user_id()
    {
      /*
      $this->hasOne('App\Model name','column in mode',' reffrences column');

      this function return the row in users table where id =user_id
      */
      return $this->hasOne('App\User','id','user_id');//return one object
    }
}
