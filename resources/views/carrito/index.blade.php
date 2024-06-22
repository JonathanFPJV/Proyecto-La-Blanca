@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tu Carrito</h1>
    @if(empty($carrito))
        <p>Tu carrito está vacío.</p>
    @else
        <ul class="list-group">
            @foreach($carrito as $id => $detalle)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>{{ $detalle['nombre'] }} - ${{ $detalle['precio'] }} (Cantidad: {{ $detalle['cantidad'] }})</div>
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
        <a href="{{ route('checkout') }}" class="btn btn-success mt-3">Checkout</a>
    @endif
</div>
@endsection

