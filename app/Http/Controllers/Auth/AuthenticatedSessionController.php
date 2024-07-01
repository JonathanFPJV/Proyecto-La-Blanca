<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validar el request
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'error' => 'Usuario o contraseña incorrecta.'
            ]);
        }
        $user = Auth::user();
        if ($user->estado !== 'activo') {
            Auth::logout();
            throw ValidationException::withMessages([
                'error' => 'La cuenta ha sido eliminada.',
            ]);
        }

        // Autenticar al usuario
        $request->authenticate();

        // Regenerar la sesión
        $request->session()->regenerate();

        // Verificar el tipo de usuario y redirigir
        
        if ($user->ID_Tipo == 1) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } elseif ($user->ID_Tipo == 2) {
            return redirect()->intended(route('work.dashboard', absolute: false));
        } else {
            return redirect()->intended(route('home', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse 
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
