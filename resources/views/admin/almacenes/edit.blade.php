@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Almacén</h1>
    <form action="{{ route('admin.almacenes.update', $almacen->Id_Almacen) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="Nombre_almacen">Nombre del Almacén</label>
            <input type="text" class="form-control" id="Nombre_almacen" name="Nombre_almacen" value="{{ $almacen->Nombre_almacen }}" required>
        </div>
        <div class="form-group">
            <label for="Direccion_almacen">Dirección del Almacén</label>
            <input type="text" class="form-control" id="Direccion_almacen" name="Direccion_almacen" value="{{ $almacen->Direccion_almacen }}" required>
        </div>
        <div class="form-group">
            <label for="Capacidad">Capacidad</label>
            <input type="number" class="form-control" id="Capacidad" name="Capacidad" value="{{ $almacen->Capacidad }}" required>
        </div>
        <div class="form-group">
            <label for="capacidad_disponible">Capacidad Disponible</label>
            <input type="number" class="form-control" id="capacidad_disponible" name="capacidad_disponible" value="{{ $almacen->capacidad_disponible }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ $almacen->estado }}" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $almacen->tipo }}" required>
        </div>
        <a href="{{ route('admin.almacenes.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
