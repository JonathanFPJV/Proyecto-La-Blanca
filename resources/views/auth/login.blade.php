<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="{{ asset('css/styles_log.css') }}" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="login-content">
            <h2>Iniciar Sesión</h2>
            <p class="register-link">¿Es tu primera vez? <a href="{{ route('register') }}">Regístrate</a></p>

            @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="form-container">
                @csrf

                <!-- Email Address -->
                <div class="input-group">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electrónico">
                </div>

                <!-- Password -->
                <div class="input-group">
                    <input id="password" type="password" name="password" required placeholder="Contraseña">
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
                <a href="{{ route('auth.google') }}" class="google-btn">
                    <img src="{{ asset('images/google_icon.png') }}" alt="Google" class="google-icon">Iniciar sesión con Google
                </a>
            </form>
        </div>
        <div class="login-image">
            <!-- Imagen de fondo -->
            <img src="{{ asset('images/login-image.jpg') }}" alt="Login Image">
        </div>
    </div>
</body>

</html>