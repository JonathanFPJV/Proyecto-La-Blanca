@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Orders</h1>
    @if($pedidos->isEmpty())
        <p>You have no orders.</p>
    @else
        <ul class="list-group">
            @foreach($pedidos as $pedido)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>Order #{{ $pedido->id }} - ${{ $pedido->total }}</div>
                        <div>
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
