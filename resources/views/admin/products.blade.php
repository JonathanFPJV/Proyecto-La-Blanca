@extends('layouts.app')

@section('content')
<section>
    <h1>Gestionar Productos</h1>
    <a href="{{ route('admin.productos.create') }}">Añadir Producto</a>
    <ul>
        @foreach($productos as $producto)
            <li>
                {{ $producto->Nombre_producto }} - ${{ $producto->Precio }}
                <a href="{{ route('admin.productos.edit', $producto->Id_Producto) }}">Editar</a>
                <form action="{{ route('admin.productos.destroy', $producto->Id_Producto) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
</section>
@endsection
