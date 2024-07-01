@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Carrito de Compras</h1>
        <form action="{{ route('carrito.generarPedido') }}" method="POST">
            @csrf
            @foreach($compras as $compra)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Orden: {{ $compra->id_orden }}</h5>
                        <p class="card-text">Estado: {{ $compra->Estado }}</p>
                        <a href="{{ route('carrito.remove', $compra->id_orden) }}" class="btn btn-danger float-right">
                            <i class="fas fa-trash-alt"></i> Eliminar Compra
                        </a>
                        @foreach($compra->logistica as $logistica)
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/' . $logistica->producto->imagen) }}" alt="{{ $logistica->producto->Nombre_producto }}" width="100" height="100">
                                </div>
                                <div class="col-md-3">
                                    <h5>{{ $logistica->producto->Nombre_producto }}</h5>
                                    <p>Descripción: {{ $logistica->producto->Descripcion }}</p>
                                    <p>Precio: S/.{{ $compra->Monto }}</p> <!-- Mostrar el monto de la compra -->
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ route('carrito.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_logistica" value="{{ $logistica->Id_Logistica }}">
                                        <input type="number" name="quantity" value="{{ $logistica->Cantidad }}" min="1" class="form-control">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ordenes_seleccionadas[]" value="{{ $compra->id_orden }}">
                            <label class="form-check-label">
                                Seleccionar esta orden
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-success">Generar Pedido</button>
        </form>
    </div>
@endsection

