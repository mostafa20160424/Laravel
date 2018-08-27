<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;

use App\Comments;

use View;

use Session;

use Lang;

use DB;

class NewsController extends Controller
{

      public function allNews(Request $request)
      {
          $all_news = News::withTrashed()->orderBy('id','desc')->get();//not show soft deleted
          //$all_news = News::withTeashed()->orderBy('id','desc')->get(); show soft deleted
          $softDeletes = News::onlyTrashed()->orderBy('id','desc')->get();//show soft deleted
          /*
          /-----------------------------------/
          $all_news = News::orderBy('id','desc')->paginate(5);
          $all_news = News::paginate(5); = first 5 rows
          $all_news = News::all(); = all rows like fetchAll()
          $all_news = News::get('title','description'); select title,description only
          */
          return view('layout.all_news',['news'=>$all_news,'trached'=>$softDeletes]);
          //compact('variable nem') insted of array but it must have the same name variable
      }
      public function test2()
      {
        if(request()->has('action')){//request()->has('input name')
          $action = request()->get('action');
          // same request('action') = request()->input('action')
          // input('') use with post and get method
          // get('') use with get method only
        }
        return view('layout.hello',['val'=>$action]);

      }

      public function test3()
      {
        $action='';
        if(request()->has('action')){
          $action = request()->input('action');
          // same request('action') = request()->input('action')
          // input('') use with post and get method
          // get('') use with get method only
        }
        return \View::make('layout.hello')->with('val' , $action);
        // you can also use parameter in view as $val
        // you can also send more than one parameter like ->with(key,value)->with(key,value)->...

      }
      public function insert()
      {

        $attribute = [
          'title'=>trans('admin.title'), //trans(lang file.array key)
          'description'=>trans('admin.description'),//use Lang::get(lang file.array key) instedof trans()
          'statues' => trans('admin.statues')
        ];

        $data=$this->validate(request(),[
          'title'     =>'required',//input name => validation
          'description'=>'required',
          'statues'   =>'required'
        ],[],$attribute);

        $data['user_id']=auth()->user()->id;

        $insertData=News::create($data);
        // take validated data and insert to database and return the inserted data
      if(request()->ajax()){

        $html=view('layout.row',['new'=>$insertData])->render();//render mean read the text as html and load it in $html

        return response(['statues'=>true,'result'=>$html]);//response function return data object
      }

        session()->put('message','News Record Add Success'); // permanent value put(key,value)

        // $result = DB::table('news')->insert($data); not return any thing

        // $result = DB::table('news')->insertGeiId($data); return the new record id

        //session()->push('message',['key1'=>News Record Add Success']) = Session::push // session array

        //session()->flash('message','News Record Add Success') // show session and destroy it in relode

        //session()->flush() to destroy all sessions
        /*
        News::updateOrCreate([ // "mean if dat exist update else create"
        'title'     =>request('title'),
        'add_by'    =>request('add_by'),
        'description'=>request('desciption'),
        'statues'   =>request('statues')
        ]);
        */
        /*
        /-------------------------------Another wayTo Insert--------------------/
        News::create([
        'column name'=>request('input name'),
        'title'=>request('title'),
        ]);
        News::firstOrNew([
        'column name'=>request('input name'),
        'title'=>request('title'),
      ]);
      News::firstOrCreate([
      'column name'=>request('input name'),
      'title'=>request('title'),
      ]);
        $add = new News();
        $add->title=request('title');
        $add->add_by=request('addedBy');
        $add->description=request('description');
        $add->statues=request('statues');
        $add->save();
        /----------------------------------------------------------------------/
        */
        return redirect('getAll');//redirect(url)
      }

      public function delete($id)
      {
        $delete = News::find($id);
        $delete->delete();
        return redirect('getAll');
      }

      public function deleteMulti($id=null)
      {
        if($id){
          $delete = News::find($id);
          $delete->delete();
        }elseif (request()->has('restore') and request()->has('id')) {
          News::whereIn('id',request('id'))->restore();//because id is an array
        }elseif (request()->has('forcedelete') and request()->has('id')) {
           //News::destroy(request('id')); will not delete because you use softDeletes method in migration file
           News::whereIn('id',request('id'))->forceDelete();
        }
        elseif (request()->has('softdelete') and request()->has('id')) {
           News::destroy(request('id'));
            //will not delete because you use softDeletes method in migration file
        }


        return redirect('getAll');
      }

      public function show($id)//parameter get from link by $_GET
      {
        $new=News::find($id);
        //$new=News::with('user_id')->find($id); will return row refrences to user_id column value
        //also $new->user_id()->first()->name to print name
        return view('layout.show',['new'=>$new]);
      }

      public function add_comment($news_id)
      {
        $data= $this->validate(request(),[
          'comment'=>'required',
        ]);
        $data['user_id']=auth()->user()->id;
        $data['news_id']=$news_id;
        Comments::create($data);

        return back();
      }

      function getSpecify()
      {
        $news = DB::table('news')->where([
          ['status', '=', '1'],
          ['subscribed', '<>', '1'],
          //[key,condition,value]
        ])->get();
      }
      
      function getSameValues()
      {
        $users = DB::table('users')
        ->groupBy('account_id')
        ->having('account_id', '>', 100)
        ->get();
      }
      
      function getByJoin()
      {
        DB::table('news')
        ->join('users', function ($join) {
            $join->on('users.id', '=', 'users.user_id')
                 ->where('users.user_id', '>', 5);
        })
        ->get();
      }

      function WriteBasicQueres()
      {
        $results = DB::select('select * from users where id = :id', ['id' => 1]);
        
        DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);

        DB::delete("DELETE FROM tablename WHERE ID=?",[request('ID')]);
        //DB::table("tablename")->where("ID",request('ID'))->delete();
        
        DB::update('update users set votes = 100 where name = ?', ['John']);
        //DB::table("tablename")->where("ID",request('ID'))->update($data);

        DB::statement('drop table users');
      }
}
