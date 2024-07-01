<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Blanca</title>
    <link rel="icon" href="{{ asset('images/my_logo.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    @include('layouts.header')

    <div id="sidebar" class="sidebar">
        <ul>
            @foreach(['polos', 'pantalones', 'gorras', 'poleras', 'zapatillas', 'medias'] as $category)
            <li>
                <a href="#">{{ ucfirst($category) }}</a>
                <div class="price-filter">
                    <form action="{{ route('productos.filtrar') }}" method="GET">
                        <input type="hidden" name="categoria" value="{{ $category }}">
                        <input type="number" name="min" placeholder="Precio mínimo" style="width: 100%;">
                        <input type="number" name="max" placeholder="Precio máximo" style="width: 100%;">
                        <button type="submit">Filtrar</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>