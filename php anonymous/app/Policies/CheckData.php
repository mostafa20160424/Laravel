<?php

namespace App\Policies;

use App\News;

use Illuminate\Auth\Access\HandlesAuthorization;

class CheckData
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show_data($user)
    {
      $newsCount = News::where('user_id', $user->id)->count();
      /*News::where('user_id', $user->id) will check if any row in news table
       have user_id=id of the logged in user like "select * from news where ...."
      */
      //News::where('column name', value)->count(); return affected row count
      if($newsCount>0){// $user->column name
        return true;
      }else{
        return false;
      }
    }
}
