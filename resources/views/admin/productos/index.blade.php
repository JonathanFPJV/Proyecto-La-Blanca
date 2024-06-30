@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/adm_productos/styles_p.css') }}">

<div class="container">
    <h1>Productos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Producto</a>
    <a href="{{ route('admin.logistica.create') }}" class="btn btn-primary mb-3">Gestión Logística</a>

    <!-- Tabla para mostrar la lista de productos -->
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Almacén</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->Codigo_producto }}</td>
                    <td>{{ $producto->Nombre_producto }}</td>
                    <td>{{ $producto->Precio }}</td>
                    <td>{{ $producto->categoria->nombre_categoria }}</td>
                    <td>{{ $producto->logistica->first()->stock ?? '0' }}</td>
                    <td>{{ optional($producto->logistica->first())->almacen->Nombre_almacen ?? 'No asignado' }}</td>
                    <td>
                        <div style="display: flex; justify-content: space-between;">
                            <a href="{{ route('admin.productos.show', $producto->Id_Producto) }}" class="btn btn-warning">Ver</a>
                            <a href="{{ route('admin.productos.edit', $producto->Id_Producto) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto->Id_Producto) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
