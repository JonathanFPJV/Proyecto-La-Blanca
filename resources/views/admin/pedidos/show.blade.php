@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pedidos/styles_pd.css') }}">

<div class="container">
    <h1>Detalle del Pedido y Envío</h1>

    @if ($historialPedidoUsuario->isEmpty())
        <p>No se encontraron productos para el pedido y envío especificados.</p>
    @else
        <h2>Pedido Nº {{ $historialPedidoUsuario->first()->numero_Pedido }}</h2>
        <p>Estado del Pedido: {{ $historialPedidoUsuario->first()->estado_pedido }}</p>
        <form action="{{ route('admin.pedidos.updatePedido', $historialPedidoUsuario->first()->numero_Pedido) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="estado_pedido">Cambiar Estado del Pedido:</label>
                <select name="estado_pedido" id="estado_pedido" class="form-control">
                    <option value="pendiente">Pendiente</option>
                    <option value="en proceso">En Proceso</option>
                    <option value="completado">Completado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Estado del Pedido</button>
        </form>

        <h2>Envío Nº {{ $historialPedidoUsuario->first()->numero_envio }}</h2>
        <p>Estado del Envío: {{ $historialPedidoUsuario->first()->estado_envio }}</p>
        <form action="{{ route('admin.pedidos.updateEnvio', $historialPedidoUsuario->first()->numero_envio) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="estado_envio">Cambiar Estado del Envío:</label>
                <select name="estado_envio" id="estado_envio" class="form-control">
                    <option value="pendiente">Pendiente</option>
                    <option value="en tránsito">En Tránsito</option>
                    <option value="entregado">Entregado</option>
                    <option value="devuelto">Devuelto</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Estado del Envío</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Fecha de Pedido</th>
                    <th>Id Producto</th>
                    <th>Código de Producto</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Monto Total del Producto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historialPedidoUsuario as $historial)
                    <tr>
                        <td>{{ $historial->ID }}</td>
                        <td>{{ $historial->Nombre_Completo }}</td>
                        <td>{{ $historial->Fecha_pedido }}</td>
                        <td>{{ $historial->Id_Producto }}</td>
                        <td>{{ $historial->Codigo_producto }}</td>
                        <td>{{ $historial->Nombre_Producto }}</td>
                        <td>{{ $historial->Cantidad }}</td>
                        <td>{{ $historial->Precio_unitario }}</td>
                        <td>{{ $historial->Monto_total_producto }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('admin.pedidos.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection