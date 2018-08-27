<?php
//to create controller you should write (php artisan make:controller controller name)

//to create controller in folder you should write (php artisan make:controller folderName/controllerName)

//to create controller with All Function you should write (php artisan make:controller controllerName --resource)

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('check')->only(['getEmail']);
    }
    public function index($username)
    {
        return view('route',compact('username'));
    }
    public function home($name,$id=20160424)//you can have any number of parameter
    {
        return view('welcome',compact('name','id'));
        //compact function use to send parameter(name,id) to view page welcome.blade.php to use it
    }
    public function getEmail(Request $myrequest)//you can have any number of parameter
    {
        dd($myrequest->email);//email is name of textfiled 
    }
    public function tests($id,$username)//you can have any number of parameter
    {
        return view('route',compact('id','username'));
    }
    public function injection(\App\User $user)
    {

    }
}
