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
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'apellido' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'nombreusuario' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'digits:9', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ],[

            'name.regex' => 'El nombre solo debe contener letras.',
            'apellido.regex' => 'El apellido solo debe contener letras.',
            'nombreusuario.alpha_dash' => 'El nombre de usuario solo puede incluir letras, números, guiones y guiones bajos.',
            'name.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'nombreusuario.required' => 'El nombre de usuario es obligatorio.',
            'nombreusuario.unique' => 'Este nombre de usuario ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'Este teléfono ya está registrado.',
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

        ]);

        $userType = 3;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'apellido' => $request->apellido,
            'nombreusuario' => $request->nombreusuario,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ID_Tipo' => $userType,
            'password' => Hash::make($request->password),
            'estado' => 'activo', 
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
