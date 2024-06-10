<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        $user_google = Socialite::driver('google')->user();

        // Update or create the user
        $user = User::updateOrCreate([
            'google_id' => $user_google->id,
        ], [
            'name' => $user_google->name,
            'email' => $user_google->email,
            'avatar' => $user_google->avatar,
            'avatar_original' => $user_google->avatar_original,
            'token' => $user_google->token,
            'ID_Tipo' => 3, // Asignar automáticamente el tipo de usuario
            'estado' => 'activo', // Asignar automáticamente el estado activo
        ]);

        Auth::login($user);

        return redirect('/la_blanca');
    }
}


