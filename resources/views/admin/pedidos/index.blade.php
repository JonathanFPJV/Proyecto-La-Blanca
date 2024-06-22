@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>
    <div class="row">
        @foreach($pedidos as $pedido)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ $pedido->id }}</h5>
                        <p class="card-text">Total: ${{ $pedido->total }}</p>
                        <p class="card-text">Status: {{ $pedido->estado```blade
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>
    <div class="row">
        @foreach($pedidos as $pedido)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ $pedido->id }}</h5>
                        <p class="card-text">Total: ${{ $pedido->total }}</p>
                        <p class="card-text">Status: {{ $pedido->estado }}</p>
                        <a href="{{ route('admin.pedidos.show', $pedido->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
