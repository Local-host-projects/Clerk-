<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginpage(){
        return view('auth.signin');
    }
    public function login(Request $request){
       $data = $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:8'
        ]);
        $auth = Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        if ($auth) {
            return redirect()->route('merchant.projects') ;
        }
        return back()->with('error','Failed to login.');
        
    }
    public function register(Request $request){
        $request->validate([
            'firstname'=>'required|max:255|string',
            'lastname'=>'required|max:255|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'confirm_password'=>'required|min:8|same:password'
        ]);
        $user = User::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if($user){
            Auth::attempt($request->only('email','password'));
            return redirect()->route('merchant.projects');
        }
        return back()->with('error','Failed to Register your account , try again.');
    }
    public function middleware($role){
        return view('middleware.index',compact('role'));
    }
    
    public function registerpage(){
        return view('auth.signup');
    }
}
