<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\News;

use App\Comments;

use View;

use Session;

use Lang;

use DB;

use App\News\CheckExistsNews;

class NewsController extends Controller
{
    public function all_news()
    {
        $all_news = News::WithCount('comments_count')->orderBy('id','desc')->paginate(10);//show only 10 records
        //withCount('function name in the model') return records count
        return response(['all_news'=>$all_news]);

    }

    public function news($id)
    {
      $new = News::with('comments')->with('news_id')->find($id);
      //News::with('function name that return all comments in News Model')->find($id); it use to show relation
      //Note:function and class name in php not key senstive

      //-------------------      Another Way ---------------------

      //same use $new = News::find($id)->comments()->paginate(10);

      //News::find($id)->function in News Model->paginate(number of comments to show);

      //-------------------      end ---------------------

      return !empty($new)? response(['statues'=>true,compact('new')]) : response(['statues'=>false,'message'=>'error']);//compact(variable name)
    }

    public function add_comment()
    {
      $rules=[
          'comment'=>'required',
          'news_id'=>['required','numeric',new CheckExistsNews],
          //if key=>array() you cant represent validate as required|numeric you should send evry value individual
      ];

      $validate=Validator::make(request()->all(),$rules);

      if($validate->fails())
      {
          return response(['statues'=>false,'messages'=>$validate->messages()]);
      }else {
        $data=request()->except('_token');
        Comments::create($data);
        // -------------------------------Another way------------------------------------------
        /*
        $data['column name']=value
          $data['comment']=request('comment');
          $data['user_id']=auth()->user()->id;
          $data['news_id']=request['news_id'];
          Comments::create($data);
        */
        // -------------------------------Another way------------------------------------------
        /*
        $comment=new Comments();
        $comment->column name=value
          $comment->comment=request('comment');
          $comment->user_id=auth()->user()->id;
          $comment->news_id=request['news_id'];
          $comment->save();
        */
      }
    }
}
