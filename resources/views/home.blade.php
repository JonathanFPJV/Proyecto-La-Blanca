@extends('layouts.app')

@section('content')
<!-- Imagen de ancho completo -->
<div class="w-100">
    <img src="{{ asset('images/full-width-image.jpg') }}" class="img-fluid" alt="Full Width Image">
</div>

<!-- Primer carrusel de imágenes -->
<div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators1" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="{{ route('polos') }}">
                <img class="d-block w-100" src="{{ asset('images/slide1.jpg') }}" alt="First slide">
            </a>
        </div>
        <div class="carousel-item">
            <a href="{{ route('gorras') }}">
                <img class="d-block w-100" src="{{ asset('images/slide2.jpg') }}" alt="Second slide">
            </a>
        </div>
        <div class="carousel-item">
            <a href="{{ route('zapatillas') }}">
                <img class="d-block w-100" src="{{ asset('images/slide3.jpg') }}" alt="Third slide">
            </a>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

@endsection
