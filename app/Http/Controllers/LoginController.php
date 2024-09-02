<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm () 
    {
        return view('sessions.login');
    }

    public function store(Request $request)
    {
        //validations
        $attributes = $request->validate([
            'email' => ['required', Rule::exists('users', 'email')],
            'password' => ['required']
        ]);

        //attempt to authenticate and log the user in
        //based on the credentials
        if (auth()->attempt($attributes)) {
            Session::regenerate();
            return redirect('/')->with('success', 'Welcome!');
        }
        
        throw ValidationException::withMessages([
            'email' => 'Your credentials could not be verified'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }


}
