@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Favorites</h1>
    @if($favoritos->isEmpty())
        <p>You have no favorite items.</p>
    @else
        <ul class="list-group">
            @foreach($favoritos as $item)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>{{ $item->producto->nombre }} - ${{ $item->producto->precio }}</div>
                        <div>
                            <form action="{{ route('favoritos.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
