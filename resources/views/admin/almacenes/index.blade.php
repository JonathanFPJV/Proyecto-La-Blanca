@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/almacenes/styles_a.css') }}">

<div class="container">
    <h1>Gestión de Almacenes</h1>
    
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    
    <a href="{{ route('admin.almacenes.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Almacén</a>
    @endif
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Capacidad</th>
                    <th>Capacidad Disponible</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($almacenes as $almacen)
                <tr>
                    <td>{{ $almacen->Nombre_almacen }}</td>
                    <td>{{ $almacen->Direccion_almacen }}</td>
                    <td>{{ $almacen->Capacidad }}</td>
                    <td>{{ $almacen->capacidad_disponible }}</td>
                    <td>{{ $almacen->estado }}</td>
                    <td>{{ $almacen->tipo }}</td>
                    <td class="table-actions">
                        <a href="{{ route('admin.almacenes.edit', $almacen->Id_Almacen) }}" class="btn btn-warning btn-small">Editar</a>
                        <form action="{{ route('admin.almacenes.destroy', $almacen->Id_Almacen) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-small">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 