<!-- resources/views/carrito/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Carrito de Compras</h1>
        @foreach($compras as $compra)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Orden: {{ $compra->id_orden }}</h5>
                    <p class="card-text">Estado: {{ $compra->Estado }}</p>
                    @foreach($compra->logistica as $logistica)
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $logistica->producto->imagen) }}" alt="{{ $logistica->producto->Nombre_producto }}" width="100" height="100">
                            </div>
                            <div class="col-md-8">
                                <h5>{{ $logistica->producto->Nombre_producto }}</h5>
                                <p>Descripción: {{ $logistica->producto->Descripcion }}</p>
                                <p>Precio: S/.{{ $logistica->producto->Precio }}</p>
                                <p>Cantidad: {{ $logistica->Cantidad }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection

