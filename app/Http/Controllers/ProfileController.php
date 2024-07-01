<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Actualizar los campos proporcionados
        $user->fill($request->validated());

        // Si el email cambió, invalidar la verificación anterior
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Verificar y actualizar los campos importantes si no están presentes
        if (empty($user->apellido)) {
            $user->apellido = $request->input('apellido');
        }
        if (empty($user->nombreusuario)) {
            $user->nombreusuario = $request->input('nombreusuario');
        }
        if (empty($user->direccion)) {
            $user->direccion = $request->input('direccion');
        }
        if (empty($user->telefono)) {
            $user->telefono = $request->input('telefono');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
    
        $user = $request->user();
    
        Auth::logout();
    
        $user->estado = 'inactivo';
        $user->save();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return Redirect::to('/');
    }
}
