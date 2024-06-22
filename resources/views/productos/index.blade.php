@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos de {{ $categoria ?? 'Todos los Productos' }}</h1>
    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre_producto }}">
                    <div class="card-body">
                        <p class="card-text">{{ $producto->Descripcion }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">${{ number_format($producto->Precio, 2) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles en esta categoría.</p>
        @endforelse
    </div>
</div>
@endsection

