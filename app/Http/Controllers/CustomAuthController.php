<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
      

    public function login(LoginRequest $request)
    {
        if ($request->method() == 'get') {
            return view("auth.login");
        }
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
        return redirect(route("login"))->with('error', "Login details are invald.");
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        // $user = User::whereEmail($credentials['email'])->first();
        // dd($user->toArray());
        dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
        return redirect(route("login"))->with('error', "Login details are invald.");
    }

    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }   
    

    public function dashboard()
    {  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Auth::logout();
  
        return Redirect('login');
    }
}
