<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AuthsController extends Controller
{
//    //
//    public  function  __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function showLoginPage(){

   
        return view('authenticate.login');

    }

    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return [
                'status' => 'fail',
                'errors' => $validator->getMessageBag()->toArray()
            ];

        }
        $email = $request['email'];
        $password = $request['password'];

        if (Auth::attempt(['email' => $email , 'password' => $password])){
                return [
                    'status' => 'success',
                    'return_url' => route('home'),
                ];
        }
        else{
            session()->flash('error', 'Username and Password does not match');
            return [
                'status' => 'fail',
                'data' => 'This Email/Number does not match.'
            ];
        }

    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
    public function edit($id)
    {
    }
}
