<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');this middleware will work on all function in the controller
        $this->middleware('auth',['except'=>['testMethod']]);
        /*
          to ecept some function user
          $this->middleware('auth',['ecept'=>['function name',....] ]);
        */
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function testMethod()
    {
      return "Heloo";
    }

    public function delete_user($id)
    {
      User::find($id)->delete();
      //User::find(request('id'))->delete() ;

      return back();
    }
}
