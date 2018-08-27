<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class News extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','title','description','statues'];
    //variable name must be protected $fillabe must but the column that you insert always not put id or deleted_at
    public $timestamps = false;
    protected $data= ['deleted_at'];

    public function user_id()
    {
      /*
      $this->hasOne('App\Model name','column in this model',' reffrences column');

      this function return the row in users table where id =user_id
      */
      return $this->hasOne('App\User','id','user_id');//return one object
      // also can be return $this->belongsTo('App\User','user_id','id'); but opposite column place
    }

    public function user()
    {
      /*
      $this->hasOne('App\Model name','column in this model',' reffrences column');

      this function return the row in users table where id =user_id
      */
      return $this->hasOne('App\User','id','user_id');//return one object
    }

    public function Comments()
    {
      // $this->hasMany('App\Model name','column in this model',' reffrences column');
      return $this->hasMany('App\Comments','news_id','id');//return one array of object
    }

    public function Comments_count()
    {
      // $this->hasMany('App\Model name','column in this model',' reffrences column');
      return $this->hasMany('App\Comments','news_id','id');//return one array of object
    }

    public function news_id()
    {
      /*
      $this->hasOne('App\Model name','column in this model',' reffrences column');

      this function return the row in users table where id =user_id
      */
      return $this->hasOne('App\News','id','user_id');//return one object
    }

}
