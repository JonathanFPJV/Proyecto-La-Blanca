@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Pedidos</h1>

    <!-- Filtros compoenete filtros-pedido-->
    <x-filtros-pedidos />

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
