@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Perfil</h1>
        @if(session('status') === 'profile-updated')
            <div class="alert alert-success">
                Profile updated successfully.
            </div>
        @endif
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" id="apellido" value="{{ old('apellido', $user->apellido) }}">
                @error('apellido')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nombreusuario" class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombreusuario" class="form-control" id="nombreusuario" value="{{ old('nombreusuario', $user->nombreusuario) }}">
                @error('nombreusuario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" id="direccion" value="{{ old('direccion', $user->direccion) }}">
                @error('direccion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" id="telefono" value="{{ old('telefono', $user->telefono) }}">
                @error('telefono')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
        <form action="{{ route('profile.destroy') }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <label for="password" class="form-label">Current Password</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password', 'userDeletion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>
    </div>
@endsection

