<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function loginpage(){
        return view('auth.login');
    }
    public function login(Request $request){
        
    }
    
    
    public function registerpage(){
        return view('auth.register');
    }
}
