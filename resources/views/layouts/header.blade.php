<nav class="navbar">
    <div class="navbar-left">
        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="La Blanca"></a>
        </div>
        <div class="navbar-center">
            <a href="{{ route('polos') }}">POLOS</a>
            <a href="{{ route('pantalones') }}">PANTALONES</a>
            <a href="{{ route('gorras') }}">GORRAS</a>
            <a href="{{ route('poleras') }}">POLERAS</a>
            <a href="{{ route('zapatillas') }}">ZAPATILLAS</a>
            <a href="{{ route('medias') }}">MEDIAS</a>
        </div>
    </div>
    <div class="navbar-right">
        <div class="search-bar">
            <input type="text" placeholder="Buscar...">
            <button type="button">Buscar</button>
        </div>
        <i class="fas fa-search search-icon"></i>
        <i class="fas fa-user user-icon"></i>
        <i class="fas fa-heart" onclick="location.href='{{ route('favoritos.index') }}'"></i>
        <i class="fas fa-shopping-cart cart-icon" onclick="location.href='{{ route('carrito.index') }}'"><span class="cart-count">{{ session('carrito') ? count(session('carrito')) : 0 }}</span></i>
        <div class="user-menu">
            <div class="dropdown-menu">
                @guest
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                    <a href="{{ route('register') }}">Registrarse</a>
                @else
                    <a href="{{ route('profile.edit') }}">Perfil</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userIcon = document.querySelector('.user-icon');
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const searchIcon = document.querySelector('.search-icon');
        const searchBar = document.querySelector('.search-bar');

        userIcon.addEventListener('click', function () {
            dropdownMenu.classList.toggle('show');
        });

        searchIcon.addEventListener('click', function () {
            searchBar.classList.toggle('show');
        });

        document.addEventListener('click', function (event) {
            if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
            if (!searchIcon.contains(event.target) && !searchBar.contains(event.target)) {
                searchBar.classList.remove('show');
            }
        });
    });
</script>
