@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Administrador Dashboard</h1>
    <p>Welcome, Admin! Here you can manage your store.</p>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Control Inventario</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-primary">Control de Ordenes</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.almacenes.index') }}" class="btn btn-primary">Gestion de almacenes</a>
        </div>
    </div>
</div>
@endsection

