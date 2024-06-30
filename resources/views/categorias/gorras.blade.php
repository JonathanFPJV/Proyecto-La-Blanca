@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="w-100">
        <img src="{{ asset('images/gorras.png') }}" class="img-fluid" alt="Full Width Image">
    </div>
    <div class="container mt-5">
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('productos.show', $producto->Id_Producto) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 product-card" 
                             data-secondary="{{ asset('storage/' . $producto->image_1) }}">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                 class="card-img-top" 
                                 alt="{{ $producto->Nombre_producto }}">
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
</div>
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
