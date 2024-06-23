@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Administrador Dashboard</h1>
    <p>Welcome, Admin! Here you can manage your store.</p>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Manage Products</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-primary">Manage Orders</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.almacenes.index') }}" class="btn btn-primary">Manage Warehouses</a>
        </div>
    </div>
</div>
@endsection

