<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class LoginController extends Controller
{
    // 
    public function login(Request $request){
        $credentials =  $request->validate([
            'email' => ['required' ,'email', 'string'],
            'password'=> ['required', 'string']]);
       //evitar session Fixation
       $remember = $request->filled('remember');
       if(Auth::attempt($credentials, $remember)){
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
       }
    
       throw ValidationValidationException::withMessages([
        'email' => 'Estas credenciales no coinciden']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
