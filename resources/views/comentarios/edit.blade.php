@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Comment</h1>
    <form action="{{ route('comentarios.update', $comentario->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="texto">Comment</label>
            <textarea class="form-control" id="texto" name="texto" rows="3">{{ $comentario->texto }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
