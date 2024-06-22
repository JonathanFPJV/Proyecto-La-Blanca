@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Warehouse</h1>
    <form action="{{ route('admin.almacenes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Name</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group">
            <label for="ubicacion">Location</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion">
        </div>
        <button type="submit" class="btn btn-primary">Add Warehouse</button>
    </form>
</div>
@endsection
