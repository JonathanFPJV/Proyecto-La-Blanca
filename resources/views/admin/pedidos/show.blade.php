@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order #{{ $pedido->id }}</h5>
            <p class="card-text">Total: ${{ $pedido->total }}</p>
            <p class="card-text">Status: {{ $pedido->estado }}</p>
            <h6>Items:</h6>
            <ul>
                @foreach($pedido->items as $item)
                    <li>{{ $item->producto->nombre }} - ${{ $item->producto->precio }} x {{ $item->cantidad }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
