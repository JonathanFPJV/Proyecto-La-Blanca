@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <img src="{{ asset('images/historia.png') }}" class="img-fluid w-100" alt="Banner Image">
    <div class="container nuestra-historia mt-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/nuestra.png') }}" class="img-fluid" alt="Full Width Image">
            </div>
            <div class="col-md-6">
                <h2 class="highlight-text">LA BLANCA</h2>
                <p>
                    La tienda "La Blanca" fue fundada en 2024 por un grupo de seis visionarios apasionados por la moda y la calidad. Apaza Mamani Josue, Idme Puma Aldo, Juli Velazco Jhonathan, Mayta Quispe Jose, Zarate Linares Gael y Ventura Cutire Yamil unieron sus talentos y experiencias para crear una marca que refleja elegancia y autenticidad. Cada fundador aportó una perspectiva única y habilidades diversas, desde el diseño y la confección hasta la gestión empresarial y el marketing.
                </p>
                <p>
                    Con una visión clara de ofrecer productos de alta calidad a precios accesibles, "La Blanca" se ha convertido rápidamente en un referente en el mundo de la moda. La tienda se especializa en ropa casual y elegante, utilizando los mejores materiales y técnicas de fabricación innovadoras. Su compromiso con la sostenibilidad y la responsabilidad social ha resonado fuertemente entre sus clientes, quienes valoran tanto el estilo como la ética detrás de cada prenda.
                </p>
                <p>
                    Además de su impresionante línea de productos, "La Blanca" se destaca por su atención al cliente excepcional y una experiencia de compra inigualable. Los fundadores creen firmemente en la importancia de construir relaciones duraderas con sus clientes, y esto se refleja en cada aspecto de la tienda, desde el diseño de la tienda física hasta su presencia en línea.
                </p>
                <a href="{{ url('/') }}" class="btn btn-dark mt-3">Volver al Inicio</a>
            </div>
        </div>
    </div>
</div>
@endsection

