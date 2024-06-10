<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'nombreusuario' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $userType = 3; // Por defecto 'Cliente'
        
        // Si el registro es realizado por un Administrador
        if (Auth::check() && Auth::user()->ID_Tipo == 1) {
            $request->validate([
                'ID_Tipo' => ['required', 'integer', 'in:1,2,3'],
            ]);
            $userType = $request->ID_Tipo;
        }

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'nombreusuario' => $request->nombreusuario,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ID_Tipo' => $userType,
            'estado' => 'activo', // colocamos el estado de activo
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
