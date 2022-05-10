<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VendorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }

    public function getLogin(){

        return view('user.auth.login');
  
      }
  

    public function Login(LoginRequest $request){
      
            
        $remember_me = $request->has('remember_me') ? true : false;

                
        if (auth()->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
             return redirect()->intended( route('vendor.vendors'));
         }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
    
         return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
     }
    
    
    
     public function logout( Request $request )
    {
    
        
        if(Auth::check()) // this means that the admin was logged in.
        {
            Auth::logout();
            return redirect()->route('get.user.login');
        }
    
        $this->guard()->logout();
        $request->session()->invalidate();
    
        return $this->loggedOut($request) ?: redirect()->route('get.user.login');
    }


    


}
