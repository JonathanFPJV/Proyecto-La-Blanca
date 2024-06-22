@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Medias</h1>
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->Nombre_producto }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->Nombre_producto }}</h5>
                        <p class="card-text">{{ $producto->Descripcion }}</p>
                        <p class="card-text"><strong>Precio:</strong> ${{ $producto->Precio }}</p>
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
