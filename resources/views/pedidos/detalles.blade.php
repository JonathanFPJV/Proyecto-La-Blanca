@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalles del Pedido</h1>
    @foreach($productos as $producto)
        <div class="bg-white mt-4 p-4 border border-gray-300 hover:border-indigo-300 hover:ring hover:ring-indigo-200 hover:ring-opacity-50 rounded-md shadow-sm">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre_producto }}" width="50" height="50">
                    @else
                        <img src="{{ asset('images/default.png') }}" alt="Producto" width="50" height="50">
                    @endif
                </div>
                <div class="flex-grow-1">
                    <p class="mb-1 font-weight-bold text-dark">
                        Producto: {{ $producto->Nombre_producto }}
                    </p>
                    <p class="mb-1 text-muted">
                        Cantidad: {{ $producto->Cantidad }}
                    </p>
                    <p class="mb-1 text-muted">
                        Precio Unitario: ${{ $producto->Precio }}
                    </p>
                    <p class="mb-1 text-muted">
                        Monto Total del Producto: ${{ $producto->Monto_total_producto }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

