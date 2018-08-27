<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Validator;

class User extends Controller
{
    public function login()
    {
        $rules=[
            'email'=>'required|email',
            'password'=>'required',
        ];

        $validate=Validator::make(request()->all(),$rules);

        if($validate->fails())
        {
            return response(['statues'=>false,'messages'=>$validate->messages()]);
        }
        else{
            if(auth()->attempt(['email'=>request('email'),'password'=>request('password')]))
            {
                $user = auth()->user();// $user = validate row

                $user->api_token=str_random(20);//$user->column name

                $user->save();

                return response(['statues'=>true,'user'=>$user,'token'=>$user->api_token]);

            }else{
                return response(['statues'=>false,'message'=>'invalid information']);                
            }
        }
    }
}
