@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <img src="{{ asset('images/carrito.png') }}" class="img-fluid w-100" alt="Carrito Banner">
</div>
<div class="container mt-5">
    <h1>Tu Carrito</h1>
    @if(empty($carrito))
        <p>Tu carrito está vacío.</p>
    @else
        <ul class="list-group">
            @foreach($carrito as $id => $detalle)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $detalle['imagen']) }}" alt="{{ $detalle['nombre'] }}" class="img-thumbnail mr-3" style="width: 100px; height: auto;">
                            <div>
                                <div>{{ $detalle['nombre'] }} - S/.{{ $detalle['precio'] }} (Cantidad: {{ $detalle['cantidad'] }})</div>
                            </div>
                        </div>
                        <div>
                            <form action="{{ route('carrito.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('checkout') }}" class="btn btn-success mt-3">Realizar Compra</a>
    @endif
</div>
@endsection
