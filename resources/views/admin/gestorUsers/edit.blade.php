@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.gestorUsers.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $user->apellido) }}" required>
        </div>

        <div class="form-group">
            <label for="nombreusuario">Nombre de Usuario:</label>
            <input type="text" class="form-control" id="nombreusuario" name="nombreusuario" value="{{ old('nombreusuario', $user->nombreusuario) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $user->direccion) }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}" required>
        </div>

        <div class="form-group">
            <label for="ID_Tipo">Tipo de Usuario:</label>
            <select class="form-control" id="ID_Tipo" name="ID_Tipo" required>
                @foreach ($tipoUsuarios as $tipoUsuario)
                    <option value="{{ $tipoUsuario->ID_Tipo }}" {{ $user->ID_Tipo == $tipoUsuario->ID_Tipo ? 'selected' : '' }}>
                        {{ $tipoUsuario->Nombre_tipo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="password">Contraseña (dejar en blanco para no cambiarla):</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        <a href="{{ route('admin.gestorUsers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

