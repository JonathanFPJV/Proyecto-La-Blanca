@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $producto->nombre }}</h1>
    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
    <p>{{ $producto->descripcion }}</p>
    <p>Price: ${{ $producto->precio }}</p>
    <p>Stock: {{ $producto->stock }}</p>
    <a href="{{ route('carrito.add', $producto->id) }}" class="btn btn-primary">Add to Cart</a>
    <a href="{{ route('favoritos.add', $producto->id) }}" class="btn btn-secondary">Add to Favorites</a>
</div>
@endsection
