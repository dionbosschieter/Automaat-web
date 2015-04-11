<?php namespace App\Http\Controllers;

use Auth;
use Request;

class AuthController extends Controller {

    public function login()
    {
       return view('login');
    }

    public function authenticate()
    {
        $username = Request::input('username');
        $password = Request::input('password');

        if(Auth::attempt(['username' => $username, 'password' => $password]))
        {
            return redirect()->intended('/');
        } else {
            dd(false);
        }
    }

}