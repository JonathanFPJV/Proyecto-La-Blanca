@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Products</h1>
    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary mb-3">Add New Product</a>
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text">${{ $producto->precio }}</p>
                        <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
