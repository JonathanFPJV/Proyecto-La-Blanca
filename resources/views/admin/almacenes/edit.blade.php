@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Warehouse</h1>
    <form action="{{ route('admin.almacenes.update', $almacen->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nombre">Name</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $almacen->nombre }}">
        </div>
        <div class="form-group">
            <label for="ubicacion">Location</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $almacen->ubicacion }}">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
