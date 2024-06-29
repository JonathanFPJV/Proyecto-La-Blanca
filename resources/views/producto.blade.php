@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="position-relative">
        <a href="javascript:history.back()" class="close-btn">&times;</a>
    </div>
    <div class="row">
        <div class="col-md-2">
            <!-- Miniaturas de imágenes -->
            <div class="d-flex flex-column">
                @if($producto->imagen)
                    <img class="img-thumbnail mb-2" src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre_producto }}" data-target="#productCarousel" data-slide-to="0">
                @endif
                @foreach(['image_1', 'image_2', 'image_3', 'image_4'] as $index => $imageField)
                    @if($producto->$imageField)
                        <img class="img-thumbnail mb-2" src="{{ asset('storage/' . $producto->$imageField) }}" alt="{{ $producto->Nombre_producto }}" data-target="#productCarousel" data-slide-to="{{ $index + 1 }}">
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <!-- Carrusel de imágenes -->
            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @if($producto->imagen)
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->Nombre_producto }}">
                        </div>
                    @endif
                    @foreach(['image_1', 'image_2', 'image_3', 'image_4'] as $index => $imageField)
                        @if($producto->$imageField)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('storage/' . $producto->$imageField) }}" alt="{{ $producto->Nombre_producto }}">
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-card text-card-foreground">
                <h1 class="text-xl font-bold">{{ $producto->Nombre_producto }}</h1>
                <p class="text-2xl font-semibold mt-2">S/.{{ $producto->Precio }}</p>
                <p class="text-muted-foreground text-sm mt-1">Las gastos de envío se calculan en la pantalla de pagos.</p>
                <hr class="my-4 border-border" />
                <div class="mt-4">
                    <h2 class="text-lg font-semibold">TALLA</h2>
                    <div class="flex space-x-2 mt-2">
                        @foreach(explode(',', $producto->Talla) as $talla)
                            <button class="border border-border p-2 w-10 h-10 flex items-center justify-center">{{ trim($talla) }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    <label for="quantity">Cantidad</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-outline-secondary" id="decrement-btn">-</button>
                        </div>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="increment-btn">+</button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center mt-4">
                    <img aria-hidden="true" alt="secure-shipping" src="https://openui.fly.dev/openui/24x24.svg?text=🔒" />
                    <p class="ml-2 text-muted-foreground">ENVIOS A TODO EL PERU</p>
                </div>
            </div>
            <form action="{{ route('carrito.add', $producto->Id_Producto) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="mt-4 w-full border border-border bg-card text-card-foreground py-2">AGREGAR AL CARRITO</button>
                <button type="submit" formaction="{{ route('favoritos.add', $producto->Id_Producto) }}" class="mt-2 w-full bg-primary text-primary-foreground py-2"><i class="fas fa-heart"></i></button>
            </form>
        </div>
    </div>

    <!-- Recomendaciones -->
    <div class="mt-5">
        <h3>Recomendaciones para ti</h3>
        <div class="row">
            @foreach($recomendaciones as $recomendacion)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('productos.show', $recomendacion->Id_Producto) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 product-card" data-secondary="{{ asset('storage/' . $recomendacion->image_1) }}">
                            <img src="{{ asset('storage/' . $recomendacion->imagen) }}" class="card-img-top" alt="{{ $recomendacion->Nombre_producto }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recomendacion->Nombre_producto }}</h5>
                                <p class="card-text"><strong>Precio:</strong> s/.{{ $recomendacion->Precio }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Historial de productos vistos recientemente -->
    <div class="mt-5">
        <h3>VISTOS RECIENTEMENTE</h3>
        <div class="row">
            @foreach($productos_historial as $historial)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('productos.show', $historial->Id_Producto) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 product-card" data-secondary="{{ asset('storage/' . $historial->image_1) }}">
                            <img src="{{ asset('storage/' . $historial->imagen) }}" class="card-img-top" alt="{{ $historial->Nombre_producto }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $historial->Nombre_producto }}</h5>
                                <p class="card-text"><strong>Precio:</strong> s/.{{ $historial->Precio }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/producto.css') }}">
@endsection

@section('scripts')
<script>
    document.getElementById('decrement-btn').addEventListener('click', function() {
        var quantity = document.getElementById('quantity');
        if (quantity.value > 1) {
            quantity.value--;
        }
    });

    document.getElementById('increment-btn').addEventListener('click', function() {
        var quantity = document.getElementById('quantity');
        quantity.value++;
    });

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
