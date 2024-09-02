<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('sessions.register');
    }

    public function store(Request $request)
    {
        // Register the user
        $attributes = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:255']
        ]);

        $user = User::create($attributes);

         //log the user in - ele cria a conta e fica automaticamente logado
        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
