<!-- resources/views/layouts/navigation.blade.php -->
<nav class="bg-gray-800 p-2 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Logo -->
            <a href="/" class="flex items-center text-white space-x-1">
                <img src="/path/to/your/logo.png" alt="Logo" class="h-8 w-8">
                <span class="font-semibold text-xl tracking-tight">Men</span>
            </a>
            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="#" class="text-white hover:text-gray-300">Productos</a>
                <a href="#" class="text-white hover:text-gray-300">Nueva Colección</a>
                <a href="#" class="text-white hover:text-gray-300">Promociones</a>
            </div>
        </div>
        <!-- Search bar -->
        <div class="relative mx-4">
            <input type="text" placeholder="Search" class="pl-3 pr-10 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600">
            <button class="absolute right-0 top-0 mt-2 mr-3">
                <svg class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.477 12.477h-.79l-.279-.27a6.518 6.518 0 001.577-5.197C13.63 3.229 10.78.38 7.315.38S1 3.23 1 6.71s2.85 6.33 6.33 6.33c1.444 0 2.771-.5 3.843-1.336l.27.28v.79l5.015 5.015c.31.31.803.31 1.112 0l.94-.94a.786.786 0 000-1.112l-5.015-5.015zM7.33 10.62A3.92 3.92 0 013.41 6.7a3.92 3.92 0 013.92-3.92 3.92 3.92 0 013.92 3.92 3.92 3.92 0 01-3.92 3.92z"/>
                </svg>
            </button>
        </div>
        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            <a href="#" class="text-white bg-red-600 px-3 py-2 rounded-full">Iniciar Sesion</a>
            <a href="#" class="text-white hover:text-gray-300">
                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 000 2h8a1 1 0 100-2H6zM3 6a1 1 0 000 2h14a1 1 0 100-2H3zm2 4a1 1 0 000 2h10a1 1 0 100-2H5zm-2 4a1 1 0 000 2h14a1 1 0 100-2H3z"/>
                </svg>
            </a>
        </div>
    </div>
</nav>
