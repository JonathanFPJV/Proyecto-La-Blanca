@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>Administrar productos</h1>
    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Producto</a>
    <a href="{{ route('admin.logistica.create') }}" class="btn btn-primary mb-3">Gestion Logistica</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Código</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nombre</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Precio</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Categoría</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Stock</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Almacén</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    @forelse ($producto->logistica as $logistica)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->Codigo_producto }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->Nombre_producto }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->Precio }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->categoria->nombre_categoria }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $logistica->stock }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                @if($logistica->almacen)
                                    {{ $logistica->almacen->Nombre_almacen }}
                                @else
                                    No asignado
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                <a href="{{ route('admin.productos.show', $producto->Id_Producto) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('admin.productos.edit', $producto->Id_Producto) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('admin.productos.destroy', $producto->Id_Producto) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->Codigo_producto }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->Nombre_producto }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->Precio }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $producto->categoria->nombre_categoria }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">0</td>
                            <td class="py-2 px-4 border-b border-gray-200">No asignado</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                <a href="{{ route('admin.productos.show', $producto->Id_Producto) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('admin.productos.edit', $producto->Id_Producto) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('admin.productos.destroy', $producto->Id_Producto) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforelse
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

