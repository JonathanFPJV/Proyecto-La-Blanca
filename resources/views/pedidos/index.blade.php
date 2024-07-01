@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Mis Pedidos</h1>
    @foreach($pedidos as $pedido)
        <div class="bg-white mt-4 p-4 border border-gray-300 hover:border-indigo-300 hover:ring hover:ring-indigo-200 hover:ring-opacity-50 rounded-md shadow-sm">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600" width="24" height="24" viewBox="0 0 24 24" xml:space="preserve">
                        <path d="M12 20H0v-3.5c0-2.4 1.3-4.5 3.2-5.6C2.5 10.2 2 9.2 2 8.1c0-2.2 1.8-4 4-4s4 1.8 4 4c0 1.1-.4 2.1-1.2 2.8 1.9 1.1 3.2 3.3 3.2 5.6V20zM2 18h8v-1.5c0-2.4-1.8-4.5-4-4.5-2.1 0-4 2.1-4 4.5V18zM6 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm18 11H14v-2h10v2zm-3-4h-7v-2h7v2zm3-4H14V7h10v2z"/>
                    </svg>
                </div>
                <div class="flex-grow-1">
                    <p class="mb-1 font-weight-bold text-dark">
                        Pedido #{{ $pedido->n_Pedido }}
                    </p>
                    <p class="mb-1 text-muted">
                        Fecha del Pedido: {{ $pedido->Fecha_pedido }}
                    </p>
                    <p class="mb-1 text-muted">
                        Monto Total: ${{ $pedido->Monto_total }}
                    </p>
                    <p class="mb-1 text-muted">
                        Estado del Pedido: {{ $pedido->Estado }}
                    </p>
                    <p class="mb-1 text-muted">
                        Fecha de Entrega: {{ $pedido->fecha_entrega }}
                    </p>
                    <p class="mb-1 text-muted">
                        Estado del Envío: {{ $pedido->EstadoEnvio }}
                    </p>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('pedidos.detalles', $pedido->n_Pedido) }}" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
