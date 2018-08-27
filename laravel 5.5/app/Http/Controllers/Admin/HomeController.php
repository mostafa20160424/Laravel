<?php
//to create controller you should write (php artisan make:controller controller name)

//to create controller in folder you should write (php artisan make:controller folderName/controllerName)

//to create controller with All Function you should write (php artisan make:controller controllerName --resource)
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('route');
    }
    public function home($name,$id=20160424)//you can have any number of parameter
    {
        return view('welcome',compact('name','id'));
    }
    public function getEmail(Request $myrequest)//you can have any number of parameter
    {
        dd ($myrequest->email);
    }

}
