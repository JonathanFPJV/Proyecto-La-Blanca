@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comments</h1>
    @if($comentarios->isEmpty())
        <p>No comments yet.</p>
    @else
        <ul class="list-group">
            @foreach($comentarios as $comentario)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>{{ $comentario->texto }}</div>
                        <div>
                            <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
