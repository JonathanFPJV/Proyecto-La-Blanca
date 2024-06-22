@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        @if(session('status') === 'profile-updated')
            <div class="alert alert-success">
                Profile updated successfully.
            </div>
        @endif
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
        <form action="{{ route('profile.destroy') }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <label for="password" class="form-label">Current Password</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password', 'userDeletion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>
    </div>
@endsection
