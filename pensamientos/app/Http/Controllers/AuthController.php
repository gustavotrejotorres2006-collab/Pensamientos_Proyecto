<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string', 'max:150'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Ingresa tu usuario o correo.',
            'password.required' => 'Ingresa tu contraseña.',
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $loginCredentials = [
            $field => $credentials['login'],
            'password' => $credentials['password'],
            'is_active' => true,
        ];

        if (! Auth::attempt($loginCredentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['login' => 'Las credenciales no son correctas.'])
                ->withInput($request->only('login'));
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('home'))
            ->with('success', 'Bienvenido de nuevo.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Ingresa tu nombre.',
            'username.required' => 'Ingresa un nombre de usuario.',
            'username.alpha_dash' => 'El usuario solo puede contener letras, números, guiones y guiones bajos.',
            'username.unique' => 'Ese nombre de usuario ya está ocupado.',
            'email.required' => 'Ingresa tu correo electrónico.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.unique' => 'Ese correo ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'name' => trim($data['name']),
            'username' => strtolower($data['username']),
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
            'is_active' => true,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('success', 'Tu cuenta fue creada correctamente.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
