<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Dashboard Administrador</title>
</head>

<body>
    <header class="admin-header">
        <h1>Panel de Administración</h1>
    </header>
    <div class="admin-container">
        <div class="admin-sidebar">
            <ul>
                <li class="{{ request()->is('admin') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="{{ request()->is('admin/productos') || request()->is('admin/productos/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.productos.index') }}">Productos</a>
                </li>
                <li class="{{ request()->is('admin/pedidos') ? 'active' : '' }}">
                    <a href="{{ route('admin.pedidos.index') }}">Pedidos</a>
                </li>
                <li class="{{ request()->is('admin/almacenes') ? 'active' : '' }}">
                    <a href="{{ route('admin.almacenes.index') }}">Almacenes</a>
                </li>
            </ul>
            <!-- Enlace separado para mantenerlo en la parte inferior de la barra lateral -->
            <a href="{{ url('/') }}">Ir a la página principal</a>
        </div>
        <div class="admin-content">
            @yield('content')
        </div>
    </div>
</body>
</html>
