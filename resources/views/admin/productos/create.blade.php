@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="Codigo_producto">Código del Producto</label>
            <input type="text" class="form-control" id="Codigo_producto" name="Codigo_producto" required autofocus>
            <x-input-error :messages="$errors->get('Codigo_producto')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="Nombre_producto">Nombre del Producto</label>
            <input type="text" class="form-control" id="Nombre_producto" name="Nombre_producto" required>
        </div>
        <div class="form-group">
            <label for="Descripcion">Descripción</label>
            <textarea class="form-control" id="Descripcion" name="Descripcion" required></textarea>
        </div>
        <div class="form-group">
            <label for="Precio">Precio</label>
            <input type="number" class="form-control" id="Precio" name="Precio" required>
        </div>
        <div class="form-group">
            <label for="id_categoria">Categoría</label>
            <select class="form-control" id="id_categoria" name="id_categoria" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Talla">Talla</label>
            <input id="Talla" class="form-control" type="text" name="Talla" required />
            <x-input-error :messages="$errors->get('Talla')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="Color">Color</label>
            <input id="Color" class="form-control" type="text" name="Color" required />
            <x-input-error :messages="$errors->get('Color')" class="mt-2" />
        </div>
        <div class="form-group">
            <label for="imagen">Imagen principal</label>
            <input type="file" class="form-control" id="imagen" name="imagen" required>
        </div>
        <div class="form-group">
            <label for="image_1">Imagen 1</label>
            <input type="file" name="image_1" class="form-control">
        </div>
        <div class="form-group">
            <label for="image_2">Imagen 2</label>
            <input type="file" name="image_2" class="form-control">
        </div>
        <div class="form-group">
            <label for="image_3">Imagen 3</label>
            <input type="file" name="image_3" class="form-control">
        </div>
        <div class="form-group">
            <label for="image_4">Imagen 4</label>
            <input type="file" name="image_4" class="form-control">
        </div>
        
        <!-- Sección Opcional para Stock y Almacén -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="add_stock" name="add_stock">
            <label class="form-check-label" for="add_stock">
                Añadir Stock y Seleccionar Almacén
            </label>
        </div>

        <div id="stock_section" style="display: none;">
            <div class="form-group">
                <label for="almacen_id">Almacén</label>
                <select id="almacen_id" name="almacen_id" class="form-control">
                    <option value="">Seleccione un almacén</option>
                    @foreach($almacenes as $almacen)
                        <option value="{{ $almacen->Id_Almacen }}">{{ $almacen->Nombre_almacen }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('almacen_id')" class="mt-2" />
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock">
                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
    <div class="mt-3">
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>


<script>
    document.getElementById('add_stock').addEventListener('change', function() {
        const stockSection = document.getElementById('stock_section');
        stockSection.style.display = this.checked ? 'block' : 'none';
    });
</script>
@endsection
