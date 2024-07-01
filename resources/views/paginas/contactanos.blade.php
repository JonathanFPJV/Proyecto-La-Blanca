@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <img src="{{ asset('images/contacto.png') }}" class="img-fluid w-100" alt="Contact Banner">
</div>
<div class="container mt-5">
    <h1>CONTÁCTANOS</h1>
    <p>Te atenderemos lo mas pronto posible mi rey!</p>

    <h2>CONTÁCTANOS POR CORREO</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">CORREO ELECTRÓNICO</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico" required>
        </div>
        <div class="form-group">
            <label for="message">MENSAJE</label>
            <textarea name="message" class="form-control" id="message" rows="5" placeholder="Escribe tu mensaje" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a href="{{ url('/') }}" class="btn btn-secondary ml-2">Volver al Inicio</a>
        </div>
    </form>
</div>
@endsection


