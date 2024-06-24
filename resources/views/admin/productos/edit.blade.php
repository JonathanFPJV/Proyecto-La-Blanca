@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('admin.productos.update', $producto->Id_Producto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="Codigo_producto">Código del Producto</label>
            <input type="text" class="form-control" id="Codigo_producto" name="Codigo_producto" value="{{ $producto->Codigo_producto }}" required>
            <x-input-error :messages="$errors->get('Codigo_producto')" class="mt-2" />
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
            <x-input-error :messages="$errors->get('Talla')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="Color">Color</label>
            <input id="Color" class="form-control" type="text" name="Color" value="{{ $producto->Color }}" required />
            <x-input-error :messages="$errors->get('Color')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre_producto }}" class="img-thumbnail mt-2">
            @endif
        </div>
        <div class="form-group">
            <label for="image_1">Imagen 1</label>
            <input type="file" name="image_1" class="form-control">
            @if($producto->image_1)
                <img src="{{ asset('storage/' . $producto->image_1) }}" alt="{{ $producto->Nombre_producto }}" class="img-thumbnail mt-2">
            @endif
        </div>
        <div class="form-group">
            <label for="image_2">Imagen 2</label>
            <input type="file" name="image_2" class="form-control">
            @if($producto->image_2)
                <img src="{{ asset('storage/' . $producto->image_2) }}" alt="{{ $producto->Nombre_producto }}" class="img-thumbnail mt-2">
            @endif
        </div>
        <div class="form-group">
            <label for="image_3">Imagen 3</label>
            <input type="file" name="image_3" class="form-control">
            @if($producto->image_3)
                <img src="{{ asset('storage/' . $producto->image_3) }}" alt="{{ $producto->Nombre_producto }}" class="img-thumbnail mt-2">
            @endif
        </div>
        <div class="form-group">
            <label for="image_4">Imagen 4</label>
            <input type="file" name="image_4" class="form-control">
            @if($producto->image_4)
                <img src="{{ asset('storage/' . $producto->image_4) }}" alt="{{ $producto->Nombre_producto }}" class="img-thumbnail mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
    <div class="mt-3">
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
@endsection


