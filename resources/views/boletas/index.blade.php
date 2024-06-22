@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Receipts</h1>
    @if($boletas->isEmpty())
        <p>You have no receipts.</p>
    @else
        <ul class="list-group">
            @foreach($boletas as $boleta)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>Receipt #{{ $boleta->id }} - ${{ $boleta->total }}</div>
                        <div>
                            <a href="{{ route('boletas.show', $boleta->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
