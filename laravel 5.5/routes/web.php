<?php


Route::view('/','form');


/**************************************
    to show where Url Go 
    write(php artisan route:list)

************************************/



/*
Route::get('/text',function(){
    return 'Hi This Is My First Applicatio In Laravel';
});

*/
Route::view('/text/{username}','route',['username'=>"mostafa"]);

/*
/text/{username} must full the link text/any thing
Note array() can be write [] in php
the array keys pass to the route view
will send to the view the username=mostafa
*/
Route::get('/test/{username}','HomeController@index');
//Route::get('link','ControlName@FunctionName');

//you can write Route::get('/test','ControlName'); if Control Have Only One Function but FunctionNmae Must Be __invoke()

Route::get('/test/{name}/{id?}','HomeController@home');
//Route::get('/test/{? mean optional you can not send it}/{id}','Control Name@Function');


/*Route::post('/user/email','HomeController@getEmail');
  Route::any('/user/email','HomeController@getEmail');
         any mean can be post or get 
         because if you enter url again it regard get and will give you error if you dont put any
*/



Route::namespace('Admin')->group(function(){//namespace('foldername')
    Route::prefix('user')->group(function(){

            //will take All function from HomeController Class in Admin Folder

            /*كده كان مكتوب فيهم كلهم Route::post('/user/name you write')*/

          
            //Route::post('user/email','HomeController@getEmail')->middleware('check');

            Route::any('name','HomeController@getEmail');

            //you can use also extend namespace Route::any('name','Admin\HomeController@getEmail');

            Route::any('username','HomeController@getEmail');
            
            Route::any('pass','HomeController@getEmail');
           
        });
});

/**********Local Constraint*************/

Route::get('/text/{id}/{username}','HomeController@tests')->where(['id'=>'[0-9]+' , 'username'=>'[A-Za-z]+' ])->name('Profile');

//name('Profile') to give name to the URL


/**********Global Constraint*************

write in RouteServiceProvider.php Any Constraint Like you want evrey id enter must be number so Write

Route::pattern('id','[0-9]+'); 

*******************End************************/

/*---------------------__invoke() function------------------*/
Route::get('/profile/{id}','Profile');

//Controller Can Have Function Its Name Must Be __invoke() its Call With Only Call The Controller


/*-----------------------------End-----------------------------*/

/****************************Start Resources******************************/

//Route::resource('link','ControllerName');

Route::resource('admin','User');

//if you want to stop any function write ['except',['functionName',....]]


//Route::resource('admin','User',['except'=>['edit']]);


//if you want to running specific functions write ['only',['functionName',....]]


//Route::resource('admin','User',['only'=>['edit']]);

/*******************************End Resouces************************************/



/***************************Start MiddleWare*******************************/

Route::post('user/email','HomeController@getEmail')->middleware('check:admin@gmail.com');

Route::get('cannot',function(){
    return "Cannot Access With This Email";
});
Route::get('success',function(){
    return "Can Access With This Email";
});




/* 


->middleware('middleware name:value pass to function handle in middleware class')

 middleware name is the key in $routeMiddleware array

  public function __construct()
  {
    $this->middleware('check')->only(['getEmail']);only['functionName That You Want Running The MiddleWare In It',...]
  }


if you want to running the MiddleWare In The Controller
write in Th Controller Class Constructor $this->middleware('middleware name');

        if you want running many middleware  in the same route write


            Route::group(['middleware'=>['check',...route name]],function(){
                Route::post('user/email','HomeController@getEmail');
            });

            Another Way To Group MiddleWare

            in kernel.php in $middlewaregroup variable write 

            'groupName'=>[
                \App\Http\Middleware\CheckEmail::class,
                Middleware Class That you Create in Middle Ware Folder Path::class
                ]

                and to running middleware write in routs page (web.php) 

            Route::group(['middleware'=>['groupName']],function(){
                Route::post('user/email','HomeController@getEmail'); the 
            });
*/  

/***************************End MiddleWare*******************************/