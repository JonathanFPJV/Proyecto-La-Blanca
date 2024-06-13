<x-guest-layout>
    <form method="POST" action="{{ route('almacenes.store') }}">
        @csrf

        <!-- Nombre del Almacén -->
        <div>
            <x-input-label for="Nombre_almacen" :value="__('Nombre del Almacén')" />
            <x-text-input id="Nombre_almacen" class="block mt-1 w-full" type="text" name="Nombre_almacen" :value="old('Nombre_almacen')" required autofocus />
            <x-input-error :messages="$errors->get('Nombre_almacen')" class="mt-2" />
        </div>

        <!-- Dirección del Almacén -->
        <div class="mt-4">
            <x-input-label for="Direccion_almacen" :value="__('Dirección del Almacén')" />
            <x-text-input id="Direccion_almacen" class="block mt-1 w-full" type="text" name="Direccion_almacen" :value="old('Direccion_almacen')" required />
            <x-input-error :messages="$errors->get('Direccion_almacen')" class="mt-2" />
        </div>

        <!-- Capacidad -->
        <div class="mt-4">
            <x-input-label for="Capacidad" :value="__('Capacidad')" />
            <x-text-input id="Capacidad" class="block mt-1 w-full" type="number" name="Capacidad" :value="old('Capacidad')" required />
            <x-input-error :messages="$errors->get('Capacidad')" class="mt-2" />
        </div>


        <!-- Estado -->
        <div class="mt-4">
            <x-input-label for="estado" :value="__('Estado')" />
            <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado" :value="old('estado')" required />
            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
        </div>

        <!-- Tipo -->
        <div class="mt-4">
            <x-input-label for="tipo" :value="__('Tipo')" />
            <x-text-input id="tipo" class="block mt-1 w-full" type="text" name="tipo" :value="old('tipo')" required />
            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('almacenes.index') }}">
                {{ __('Cancelar') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Crear') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>


