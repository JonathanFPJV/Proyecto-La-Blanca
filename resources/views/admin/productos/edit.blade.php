@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nombre">Name</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}">
        </div>
        <div class="form-group">
            <label for="descripcion">Description</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{ $producto->descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="precio">Price</label>
            <input type="number" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}">
        </div>
        <div class="form-group">
            <label for="imagen">Image</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="img-thumbnail mt-2">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $producto->stock }}">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
