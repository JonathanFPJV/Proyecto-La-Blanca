@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/gestorUser/styles_ge.css') }}">

<div class="container">
    <h1>Gestión de Usuarios</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón Crear Usuario con espaciado adicional después -->
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.gestorUsers.create') }}" class="btn btn-primary">Crear Usuario</a>
    </div>

    <!-- Filtro por Tipo de Usuario con espaciado propio para no estar pegado al botón -->
    <form action="{{ route('admin.gestorUsers.index') }}" method="GET" style="margin-bottom: 40px;"> <!-- Aumenta también aquí si es necesario -->
        <div class="form-group row">
            <div class="col-md-4">
                <select name="ID_Tipo" class="form-control">
                    <option value="">Todos los Tipos de Usuario</option>
                    @foreach ($tipoUsuarios as $tipoUsuario)
                        <option value="{{ $tipoUsuario->ID_Tipo }}" {{ request('ID_Tipo') == $tipoUsuario->ID_Tipo ? 'selected' : '' }}>
                            {{ $tipoUsuario->Nombre_tipo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de usuarios con adecuada separación de elementos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Tipo de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->nombreusuario }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->direccion }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->tipoUsuario ? $user->tipoUsuario->Nombre_tipo : 'Sin Tipo' }}</td>
                    <td class="table-actions">
                        <a href="{{ route('admin.gestorUsers.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.gestorUsers.destroy', $user->id) }}" method="POST" style="display:inline-flex;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
