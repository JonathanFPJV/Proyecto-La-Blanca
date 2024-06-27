@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/almacenes/styles_a.css') }}">

<div class="container">
    <h1>Añadir Nuevo Almacén</h1>
    <form action="{{ route('admin.almacenes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Nombre_almacen">Nombre del Almacén</label>
            <input type="text" class="form-control" id="Nombre_almacen" name="Nombre_almacen" required autofocus>
        </div>
        <div class="form-group">
            <label for="Direccion_almacen">Dirección del Almacén</label>
            <input type="text" class="form-control" id="Direccion_almacen" name="Direccion_almacen" required>
        </div>
        <div class="form-group">
            <label for="Capacidad">Capacidad</label>
            <input type="number" class="form-control" id="Capacidad" name="Capacidad" min="0" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Añadir Almacén</button>
            <a href="{{ route('admin.almacenes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
