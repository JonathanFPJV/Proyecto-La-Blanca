<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear una nueva cuenta</title>
    <link href="{{ asset('css/styles_reg.css') }}" rel="stylesheet">
</head>

<body>
    <div class="card">
        <h2>Crear una nueva cuenta</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <p>{{ $errors->first() }}</p>
        </div>
        @endif


        <form method="POST" action="{{ route('register') }}" class="form-container">
            @csrf

            <!-- Name and Last Name -->
            <div class="input-group">
                <input type="text" name="name" placeholder="Nombre" value="{{ old('name') }}" required>
                <input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido') }}" required>
            </div>

            <!-- User Name and Phone -->
            <div class="input-group">
                <input type="text" name="nombreusuario" placeholder="Nombre de Usuario" value="{{ old('nombreusuario') }}" required>
                <input type="text" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" required>
            </div>

            <!-- Address -->
            <div class="input-group single">
                <input type="text" name="direccion" placeholder="Dirección" value="{{ old('direccion') }}" required>
            </div>

            <!-- Email Address -->
            <div class="input-group single">
                <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="button">Crear cuenta</button>

            <!-- Already registered -->
            <p class="already-registered">
                <a href="{{ route('login') }}">¿Ya registrado?</a>
            </p>

            <!-- Google Sign-In -->
            <a href="{{ route('auth.google') }}" class="button-google">
                <img src="{{ asset('images/google_icon.png') }}" alt="Google" class="icon-google" />Registrarse con Google
            </a>
        </form>
    </div>
</body>

</html>