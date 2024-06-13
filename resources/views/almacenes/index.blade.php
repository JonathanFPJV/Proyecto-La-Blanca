<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Almacenes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-2xl font-bold">Lista de Almacenes</h3>
                        <a href="{{ route('almacenes.create') }}" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Crear Almacén</a>
                    </div>
                    @if (session('success'))
                        <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
                            <p class="font-bold">{{ session('success') }}</p>
                        </div>
                    @endif
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border-collapse">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Dirección</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Capacidad</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Capacidad Disponible</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Tipo</th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($almacenes as $almacen)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $almacen->Nombre_almacen }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $almacen->Direccion_almacen }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $almacen->Capacidad }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $almacen->capacidad_disponible }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $almacen->estado }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $almacen->tipo }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <a href="{{ route('almacenes.show', $almacen->Id_Almacen) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                            <a href="{{ route('almacenes.edit', $almacen->Id_Almacen) }}" class="ml-4 text-yellow-600 hover:text-yellow-900">Editar</a>
                                            <form action="{{ route('almacenes.destroy', $almacen->Id_Almacen) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-4 text-red-600 hover:text-red-900">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

