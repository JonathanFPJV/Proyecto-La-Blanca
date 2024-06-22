@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $producto->Nombre_producto }}</h1>
    <img src="{{ asset('storage/productos/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->Nombre_producto }}">
    <p>{{ $producto->Descripcion }}</p>
    <p><strong>Precio:</strong> ${{ $producto->Precio }}</p>
    <a href="{{ route('polos') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
