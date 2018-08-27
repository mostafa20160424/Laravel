<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Users extends Controller
{
    public function login()
    {
      return view('auth.login');
    }
    public function login_post()
    {
      $remember=request()->has('remember')?true:false;
      if(auth()->attempt(["email"=>request('email'),"password"=>request('password')],$remember)){// Auth::attempt()
        return redirect('home');
      }else{
        return back();
      }
    }
}
