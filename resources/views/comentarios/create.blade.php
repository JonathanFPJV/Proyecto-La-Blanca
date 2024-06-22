@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a Comment</h1>
    <form action="{{ route('comentarios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="texto">Comment</label>
            <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
