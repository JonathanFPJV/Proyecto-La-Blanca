<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="{{ asset('css/styles_log.css') }}" rel="stylesheet">
</head>
<body>
    <div class="card">
        <h2>Iniciar Sesión</h2>
        <p class="register-link">¿Es tu primera vez? <a href="{{ route('register') }}">Regístrate</a></p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="form-container">
            @csrf

            <!-- Email Address -->
            <div class="input-group">
                <input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="Correo electrónico" class="input-text">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="input-group">
                <input id="password" type="password" name="password" required placeholder="Contraseña" class="input-text">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Forgot Password -->
            <p class="forgot-password">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                @endif
            </p>

            <!-- Submit Button -->
            <button type="submit" class="button">Ingresar</button>

            <!-- Separator -->
            <div class="separator">o</div>

            <!-- Google Sign-In -->
            <a href="/google-auth/redirect" class="google-btn">
                <img src="https://th.bing.com/th/id/R.70d3828eb9c953441e50f122d616c91e?rik=8seAHZVho%2bGlIg&pid=ImgRaw&r=0" alt="Google" style="width: 20px; height: 20px; margin-right: 10px;">Iniciar sesión con Google
            </a>
        </form>
    </div>
</body>
</html>
