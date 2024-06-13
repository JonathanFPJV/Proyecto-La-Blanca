<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <strong>{{ __('Código del Producto') }}:</strong> {{ $producto->Codigo_producto }}
                    </div>
                    <div>
                        <strong>{{ __('Nombre del Producto') }}:</strong> {{ $producto->Nombre_producto }}
                    </div>
                    <div>
                        <strong>{{ __('Descripción') }}:</strong> {{ $producto->Descripcion }}
                    </div>
                    <div>
                        <strong>{{ __('Precio') }}:</strong> {{ $producto->Precio }}
                    </div>
                    <div>
                        <strong>{{ __('Categoría') }}:</strong> {{ $producto->Categoria }}
                    </div>
                    <div>
                        <strong>{{ __('Talla') }}:</strong> {{ $producto->Talla }}
                    </div>
                    <div>
                        <strong>{{ __('Color') }}:</strong> {{ $producto->Color }}
                    </div>
                    <div>
                        <strong>{{ __('Stock') }}:</strong> {{ $producto->logistica->first()->stock }}
                    </div>
                    <div>
                        <strong>{{ __('Almacén') }}:</strong> {{ $producto->logistica->first()->almacen->Nombre_almacen }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
