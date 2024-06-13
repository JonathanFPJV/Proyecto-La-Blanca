<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('productos.update', $producto->Id_Producto) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Campos del Producto -->
                        <div>
                            <x-input-label for="Codigo_producto" :value="__('Código del Producto')" />
                            <x-text-input id="Codigo_producto" class="block mt-1 w-full" type="text" name="Codigo_producto" value="{{ $producto->Codigo_producto }}" required autofocus />
                            <x-input-error :messages="$errors->get('Codigo_producto')" class="mt-2" />
                        </div>

                        <!-- Resto de los campos del producto -->
                        <div>
                            <x-input-label for="Nombre_producto" :value="__('Nombre del Producto')" />
                            <x-text-input id="Nombre_producto" class="block mt-1 w-full" type="text" name="Nombre_producto" value="{{ $producto->Nombre_producto }}" required />
                            <x-input-error :messages="$errors->get('Nombre_producto')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="Descripcion" :value="__('Descripción')" />
                            <x-text-input id="Descripcion" class="block mt-1 w-full" type="text" name="Descripcion" value="{{ $producto->Descripcion }}" required />
                            <x-input-error :messages="$errors->get('Descripcion')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="Precio" :value="__('Precio')" />
                            <x-text-input id="Precio" class="block mt-1 w-full" type="number" step="0.01" name="Precio" value="{{ $producto->Precio }}" required />
                            <x-input-error :messages="$errors->get('Precio')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="Categoria" :value="__('Categoría')" />
                            <x-text-input id="Categoria" class="block mt-1 w-full" type="text" name="Categoria" value="{{ $producto->Categoria }}" required />
                            <x-input-error :messages="$errors->get('Categoria')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="Talla" :value="__('Talla')" />
                            <x-text-input id="Talla" class="block mt-1 w-full" type="text" name="Talla" value="{{ $producto->Talla }}" required />
                            <x-input-error :messages="$errors->get('Talla')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="Color" :value="__('Color')" />
                            <x-text-input id="Color" class="block mt-1 w-full" type="text" name="Color" value="{{ $producto->Color }}" required />
                            <x-input-error :messages="$errors->get('Color')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="imagen" :value="__('Imagen')" />
                            <x-text-input id="imagen" class="block mt-1 w-full" type="file" name="imagen" />
                            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                        </div>

                        <!-- Seleccionar Almacén -->
                        <div class="mt-4">
                            <x-input-label for="almacen_id" :value="__('Almacén')" />
                            <select id="almacen_id" name="almacen_id" class="block mt-1 w-full">
                                @foreach($almacenes as $almacen)
                                    <option value="{{ $almacen->Id_Almacen }}" @if($almacen->Id_Almacen == $producto->logistica->first()->Id_Almacen) selected @endif>{{ $almacen->Nombre_almacen }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('almacen_id')" class="mt-2" />
                        </div>

                        <!-- Stock -->
                        <div class="mt-4">
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" value="{{ $producto->logistica->first()->stock }}" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Actualizar Producto') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

