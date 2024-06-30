@extends('layouts.app')

@section('content')
<!-- Imagen de ancho completo -->
<div class="w-100">
    <img src="{{ asset('images/full-width-image.gif') }}" class="img-fluid" alt="Full Width Image">
</div>

<!-- Rectángulo negro con texto deslizante -->
<div class="marquee-container">
    <div class="marquee">
        <span>RENUÉVA TU GUARDARROPA CON NUESTRAS EXCLUSIVAS PIEZAS DE MODA MASCULINA MI REY</span>
        <span>TU MAS QUE NADIE MERECE LO MEJOR Y LA BLANCA LO SABE</span>
        <span>ENVIOS A TODO AREQUIPA</span>
    </div>
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

<!-- Productos recomendados -->
<div class="container mt-5">
    <h2>LO MAS TOP!</h2>
    <div class="row">
        @foreach($recomendaciones as $producto)
            <div class="col-md-3 mb-4">
                <a href="{{ route('productos.show', $producto->Id_Producto) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 product-card" data-secondary="{{ asset('storage/' . $producto->image_1) }}">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->Nombre_producto }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->Nombre_producto }}</h5>
                            <p class="card-text"><strong>Precio:</strong> s/.{{ $producto->Precio }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/producto.css') }}">
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        const imgElement = card.querySelector('.card-img-top');
        const originalSrc = imgElement.src;
        const secondarySrc = card.getAttribute('data-secondary');

        card.addEventListener('mouseover', () => {
            if (secondarySrc) {
                imgElement.src = secondarySrc;
            }
        });

        card.addEventListener('mouseout', () => {
            imgElement.src = originalSrc;
        });

        card.addEventListener('mouseenter', () => {
            card.style.transform = 'scale(1.05)';
            card.style.boxShadow = '0 8px 16px rgba(0,0,0,0.3)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'scale(1)';
            card.style.boxShadow = 'none';
        });
    });
});
</script>
@endsection

