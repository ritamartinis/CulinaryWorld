<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'min:7', 'max:255', 'confirmed'],
            'profile_img' => ['nullable', 'image', 'max:2048']
        ]);

        // Atualiza os campos de nome, username e email
        $user->name = $attributes['name'];
        $user->username = $attributes['username'];
        $user->email = $attributes['email'];

        // Se a senha foi fornecida, atualize-a separadamente
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Se uma imagem de perfil foi fornecida, atualize-a
        if ($request->hasFile('profile_img')) {
            $path = $request->file('profile_img')->store('profile_images', 'public');
            $user->profile_img = $path;
        }

        // Salva as alterações
        $user->save();

        return redirect()->route('profile')->with('success', 'Your profile has been updated successfully');
    }
}
