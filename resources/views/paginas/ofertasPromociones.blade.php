@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 position-relative">
    <img src="{{ asset('images/promo.png') }}" class="img-fluid w-100 vh-100" alt="Promotional Image">
    <div class="position-absolute w-100 d-flex justify-content-center" style="bottom: 20px;">
        <a href="{{ url('/') }}" class="btn btn-dark">Volver al Inicio</a>
    </div>
</div>
@endsection

