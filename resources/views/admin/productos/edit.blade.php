@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/productos/styles_p.css') }}">

<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('admin.productos.update', $producto->Id_Producto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="Codigo_producto">Código del Producto</label>
            <input type="text" class="form-control" id="Codigo_producto" name="Codigo_producto" value="{{ $producto->Codigo_producto }}" required>
        </div>
        <div class="form-group">
            <label for="Nombre_producto">Nombre del Producto</label>
            <input type="text" class="form-control" id="Nombre_producto" name="Nombre_producto" value="{{ $producto->Nombre_producto }}" required>
        </div>
        <div class="form-group">
            <label for="Descripcion">Descripción</label>
            <textarea class="form-control" id="Descripcion" name="Descripcion" required>{{ $producto->Descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="Precio">Precio</label>
            <input type="number" class="form-control" id="Precio" name="Precio" value="{{ $producto->Precio }}" required>
        </div>
        <div class="form-group">
            <label for="id_categoria">Categoría</label>
            <select class="form-control" id="id_categoria" name="id_categoria" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->id_categoria == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Talla">Talla</label>
            <input id="Talla" class="form-control" type="text" name="Talla" value="{{ $producto->Talla }}" required />
        </div>
        <div class="form-group">
            <label for="Color">Color</label>
            <input id="Color" class="form-control" type="text" name="Color" value="{{ $producto->Color }}" required />
        </div>
        <div class="form-group">
            <label for="imagen">Imagen principal</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre_producto }}" class="img-thumbnail mt-2">
            @endif
        </div>
        <!-- Handling additional images with preview -->
        @for($i = 1; $i <= 4; $i++)
            <div class="form-group">
                <label for="image_{{ $i }}">Imagen {{ $i }}</label>
                <input type="file" class="form-control" id="image_{{ $i }}" name="image_{{ $i }}">
                @if($producto->{'image_' . $i})
                    <img src="{{ asset('storage/' . $producto->{'image_' . $i}) }}" alt="Imagen {{ $i }}" class="img-thumbnail mt-2">
                @endif
            </div>
        @endfor
        
        <div class="form-group d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection 
