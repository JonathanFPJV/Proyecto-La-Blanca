@extends('layouts.admin')

@section('content')
    <h1>Bienvenido al Dashboard de Administración</h1>
    <p>Aquí puedes administrar los elementos de tu aplicación.</p>
    
    <form method="GET" action="{{ route('admin.dashboard') }}">
        <label for="almacen_id">Seleccionar Almacén:</label>
        <select name="almacen_id" id="almacen_id">
            <!-- Aquí debes llenar las opciones con los almacenes disponibles -->
            <option value="">Todos los Almacenes</option>
            @foreach($almacenes as $almacen)
                <option value="{{ $almacen->Id_Almacen }}">{{ $almacen->Nombre_almacen }}</option>
            @endforeach
        </select>
        <button type="submit">Filtrar</button>
    </form>
    <div id="stockPorAlmacenChart">
        {!! $stockPorAlmacenChart->container() !!}
    </div>
    
    <div id="productosVendidosChart">
        {!! $productosVendidosChart->container() !!}
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $productosVendidosChart->script() }}
    {{ $stockPorAlmacenChart->script() }}
@endsection 
