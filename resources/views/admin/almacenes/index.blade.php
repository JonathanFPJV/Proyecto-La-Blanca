@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Warehouses</h1>
    <a href="{{ route('admin.almacenes.create') }}" class="btn btn-primary mb-3">Add New Warehouse</a>
    <div class="row">
        @foreach($almacenes as $almacen)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $almacen->nombre }}</h5>
                        <p class="card-text">{{ $almacen->ubicacion }}</p>
                        <a href="{{ route('admin.almacenes.edit', $almacen->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.almacenes.destroy', $almacen->id) }}" method="POST" class="d-inline">
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
