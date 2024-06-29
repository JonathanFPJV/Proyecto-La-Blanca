@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pedidos/styles_pd.css') }}">

<div class="container">
    <h1>Lista de Pedidos</h1>

    <!-- Filtros componente filtros-pedido -->
    <form class="filter-form">
        <div class="half-width">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="half-width">
            <label for="user-id">ID</label>
            <input type="text" id="user-id" name="user-id">
        </div>
        <div class="full-width">
            <label for="shipping-status">Estado de Envío</label>
            <select id="shipping-status" name="shipping-status">
                <option value="pending">Pendiente</option>
                <option value="shipped">Enviado</option>
            </select>
        </div>
        <div class="half-width">
            <label for="shipment-number">Número de envío</label>
            <input type="text" id="shipment-number" name="shipment-number">
        </div>
        <div class="half-width">
            <label for="order-number">Número de pedido</label>
            <input type="text" id="order-number" name="order-number">
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary">FILTRAR</button>
            <button type="reset" class="btn btn-secondary">RESET</button>
        </div>
    </form>

    @if ($historialPedidos->isEmpty())
    <p>No se encontraron pedidos</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número Pedido</th>
                <th>Número Envío</th>
                <th>Nombre Completo</th>
                <th>Fecha Pedido</th>
                <th>Estado Pedido</th>
                <th>Estado Envío</th>
                <th>Monto Pedido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historialPedidos as $pedido)
            <tr>
                <td>{{ $pedido->ID }}</td>
                <td>{{ $pedido->numero_Pedido }}</td>
                <td>{{ $pedido->numero_envio }}</td>
                <td>{{ $pedido->Nombre_Completo }}</td>
                <td>{{ $pedido->Fecha_pedido }}</td>
                <td>{{ $pedido->estado_pedido }}</td>
                <td>{{ $pedido->estado_envio }}</td>
                <td>{{ $pedido->monto_total_pedido }}</td>
                <td>
                    <a href="{{ route('admin.pedidos.show', ['numero_pedido' => $pedido->numero_Pedido, 'numero_envio' => $pedido->numero_envio]) }}" class="btn btn-primary">Ver Detalles</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection