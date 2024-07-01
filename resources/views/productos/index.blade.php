@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        @forelse ($filteredProducts as $producto)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre_producto }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->Nombre_producto }}</h5>
                        <p class="card-text">{{ $producto->Descripcion }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('productos.show', $producto->Id_Producto) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            </div>
                            <small class="text-muted">s/.{{ number_format($producto->Precio, 2) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles en esta categoría o rango de precios.</p>
        @endforelse
    </div>
</div>
@endsection