@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Petugas</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="margin-bottom: 20px;">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Ganti Password</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('profil.password.update') }}" method="POST">
                @csrf
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="current_password">Password Lama</label>
                    <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                    @error('current_password')
                        <div class="text-danger" style="color: red; font-size: 0.875em;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="new_password">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                    @error('new_password')
                        <div class="text-danger" style="color: red; font-size: 0.875em;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Ganti Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
