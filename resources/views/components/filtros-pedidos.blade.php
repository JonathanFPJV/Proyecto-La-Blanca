<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    <form action="{{ route('admin.pedidos.index') }}" method="GET">
    <div class="row mb-4">
        <div class="col-md-2">
            <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre de Usuario" value="{{ request('nombre_usuario') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="id" class="form-control" placeholder="ID" value="{{ request('id') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="estado_envio" class="form-control" placeholder="Estado de Envío" value="{{ request('estado_envio') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="numero_envio" class="form-control" placeholder="Número de envio" value="{{ request('numero_envio') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="numero_pedido" class="form-control" placeholder="Número de pedido" value="{{ request('numero_pedido') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
    </form>

</div>