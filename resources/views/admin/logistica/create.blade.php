@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/productos/styles_p.css') }}">

<div class="container">
    <h1>{{ isset($logistica) ? 'Editar Logística' : 'Añadir Logística' }}</h1>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('admin.logistica.search') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="codigo_producto">Buscar por Código de Producto</label>
            <input type="text" class="form-control" id="codigo_producto" name="codigo_producto" required>
            <button type="submit" class="btn btn-primary mt-2">Buscar</button>
        </div>
    </form>

    <!-- Formulario para crear o editar logística -->
    @if(isset($logistica))
        <form action="{{ route('admin.logistica.update', $logistica->Id_Logistica) }}" method="POST" class="mb-3">
            @csrf
            @method('PUT')
    @else
        <form action="{{ route('admin.logistica.store') }}" method="POST" class="mb-3">
            @csrf
    @endif
        <div class="form-group">
            <label for="Id_Producto">Producto</label>
            <select class="form-control" id="Id_Producto" name="Id_Producto" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->Id_Producto }}" {{ isset($logistica) && $logistica->Id_Producto == $producto->Id_Producto ? 'selected' : '' }}>
                        {{ $producto->Nombre_producto }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('Id_Producto')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="Id_Almacen">Almacén</label>
            <select class="form-control" id="Id_Almacen" name="Id_Almacen" required>
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->Id_Almacen }}" {{ isset($logistica) && $logistica->Id_Almacen == $almacen->Id_Almacen ? 'selected' : '' }}>
                        {{ $almacen->Nombre_almacen }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('Id_Almacen')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ isset($logistica) ? $logistica->stock : '' }}" required>
            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
        </div>
        <div style="display: flex; justify-content: flex-start; gap: 10px;">
            <button type="submit" class="btn btn-primary">{{ isset($logistica) ? 'Actualizar' : 'Añadir' }}</button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

    @if(isset($logistica))
        <!-- Formulario para eliminar -->
        <form action="{{ route('admin.logistica.destroy', $logistica->Id_Logistica) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    @endif
</div>
@endsection
