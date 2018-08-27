<?php


/*
Note:if you edit your .env file you must restart the laravel server to show the edit
"composer create-project --prefer-dist laravel/laravel projectname 'version number.*' " to createproject
"php artisan make:model News -m" to create model and migration file
"php artisan down" close app
"php artisan up"  active the app
"php aristan route:list" show all links
php aristan make:controller name
"php aristan make:controller name -r" will create its function
*/
/*
/------------------------------------Routes Types--------------------------------------/
/GET
/POST
/PUT
/PATCH
/DELETE
/Any
*/

/*


/------------------------Pattern--------------------------/
/ will apply the validation check id is number for all pathes contain id
/ cannot take array like where
/ example Route::pattern('id','[0-9]+');
*/

Route::get('/', function () {
    $people = array('mostafa','khaled','mohamed'.'abdalla');
    return view('welcome',compact('people'));
    /* same way to send arguments
    return view('welcome')->with([
        'people'=>$people
    ]);
    */
});

Route::get('user/{id}/{name?}',function($id,$name='mostafa'){
  return 'welcome to user page userID = '.$id . ' and name = '.$name;
  /*
  /--------------------------------------------------------------------------/
  / user /{id} means that the link must containans any char after user user/char
  / user /{id?} means that the link optional containans any char after
  / put to the function parameter you send to use it
  / if you send char after link optional /link/{id?} you can use parameter in function like...
  / $id=null to not give an error

  ----------------------------------where----------------------------------------
  / put at the end of Route
  / where('id','[0-9]-') mean the id you send must be number
  / if you want check more than one parameter you can use array like ...
  / where(['id'=>'[0-9]+','name'=>'[A-Za-z]+'])
  /--------------------------------------------------------------------------/
  */
})->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);

Route::get('/about', function () {
    return view('pages.about');//folder.viewName
});

Route::get('test',function(){
/*
  /--------------------------------------------------------------------------/
  /<input type="hidden" name="_token" value="'.csrf_token().'"> must put to protect form
  / <input type="hidden" name="_method" value="PUT">
  / value of above input can be PUT if you want to send by PUT method most use with update
  / value of above input can be DELETE if you want to send by DELETE  most use with update
  / value of above input can be POST if you want to send by POST method
  / value of above input can be PATCH if you want to send by PATCH method most use with create and edit
  /--------------------------------------------------------------------------/
*/
  return '<form method="POST">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="text" class="form-control" name="txt">
            <button class="btn btn-primary">Submit</button>
            <input type="hidden" name="_method" value="PUT">
          </form>';
});

Route::post('test',function(){
  return 'welcome to post method value is ='.request('txt');//request(input name)
});

Route::put('test',function(){
  return 'welcome to put method value is ='.request('txt');
});

/*
Route::any('test',function(){
  return 'Hello';
});
/ means go to test link by any method will print Hello
*/

Route::resource('users','Users');
/*
/---------------------------------Resource-----------------------------------------/
//resource('link','Controller name');
--pathes
link //GET
link/creat // GET
link/{id}/edit // GET
link/{id} // GET show
link/{id} // PUT update
link/{id} // Delete delete
*/
Route::get('php','NewsController@test');//(link,ControllerName@FunctionName)

Route::post('test/1',function(Illuminate\Http\Request $request){
  return 'Post Method '.$request->name;
  /*
  /-------------------------------Another way-------------------------------------------/
  / return 'Post Method '.request('input name')
  /--------------------------------Another way------------------------------------------/
  / $request->all() return array have all input feilds value
  / $request->input name return input value
  */
});

Route::group(['middleware'=>'news:1'],function(){//will not show the links without login

Route::get('getAll','NewsController@allNews');

Route::post("insert/news",'NewsController@insert');

Route::delete('delete/{id?}','NewsController@deleteMulti')->where('id','[0-9]+');
/*
if you want to use sindle Middleware
EX:Route::get('getAll','NewsController@allNews')->middleware('middleware name:parameter');
EX:Route::get('getAll','NewsController@allNews')->middleware('news:1');
*/
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('manual/login', 'Users@login');
Route::post('manual/login', 'Users@login_post');
Route::get('testMethod','HomeController@testMethod');
Route::get('manual/logout',function(){
  auth()->logout();
  return redirect('manual/login');
});


Route::get('admin/path',function(){
  return view('welcome_admin');//to return admin name us Auth::guard('admin')->user()->name
})->middleware('AuthAdmin:admin');
/*
middleware('name:parameter')
if parameter is gaurd and value you send not wep or api you should register this value in config folder in auth
in gaurds array
'admin' => [
    'driver' => 'session',
    'provider' => 'admin',
],

if provider admin not exist you should register it in in providers array

'admin' => [
    'driver' => 'eloquent',
    'model' => App\Admin::class,
],
*/
Route::get('admin/login', 'Admin@login');
Route::post('admin/login', 'Admin@login_post');
Route::get('admin/logout', function(){
  auth()->guard('admin')->logout(); // = Auth::guard('admin')->logout();
  return redirect('admin/login');
});

Route::get("segment/test",function(){
  return request()->segment(1);
  //used to divide the link
  //request()->segment(1)=segment
  //request()->segment(2)=test
  //request()->segments()=array(segment,test)

});


Route::post('uplode/file','Uplode@uplode');

Route::get('EventListener',function(){
  return event(new \App\Events\Event("mostafa"));
  //will run code in function handle in Listner class
});

Route::get('getMessage',function(){
  $job = (new \App\Jobs\SendMailJob)->delay(\Carbon\Carbon::now()->addSeconds(5));
  //will send mail every 5 seconds
  dispatch($job);

  //Mail::to('php@example.com')->send(new \App\Mail\TestMail("mostafa")); send without queue job

  return "Hello";
});

Route::get('delete/user/{id}','HomeController@delete_user');

Route::get('news/{id}','NewsController@show');

Route::post('news/{id}','NewsController@add_comment');

Route::get('data/user',function(){
  if(Gate::allows('show data',auth()->user()))
  {
    return view('welcome');
  }else{
    return "you dont have permission";
  }
  /*------------------------------
  if(Gate::alows('key you defind',function parameter))
  {
    return view('welcome');
  }

  Gate key is define in AuthServiceProvider in function boot Ex:

  Gate::define('show data',function($user){
    if($user->mobile=="0124248793"){// $user->column name
      return true;
    }else{
      return false;
    }
  });

  --------------------------------*/
});

//-------------------------------------Singleton Start

\App::singleton('single',function(){
  return "Hei iam Singleton";
});
//can use helper function app()->singleton('single',function(){})
// then you can write in any view {{app('single')}} or {{App::make('single')}}
//Note if function return view you must write in the view {!! app('single') !!} to display html page not html code
//can put the singleton in AppServiceProvider in boot function and print in view
//AppServiceProvider boot function run when you run any page of project
//--------------------------------------------------
