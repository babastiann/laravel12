@extends('layouts.index')

@section('content')
<div class="container">
    <h2 class="mb-4">Account Setting</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.updateAccount') }}">
        @csrf
        @method('PUT')  <!-- Menggunakan metode PUT jika Anda ingin memperbarui data -->
        {{-- Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                id="nama" name="nama" value="{{ old('nama', $user->userable->nama ?? '') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
             @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror"
                   id="address" name="address" value="{{ old('address', $user->userable->address ?? '') }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- No. HP --}}
        <div class="mb-3">
            <label for="phone" class="form-label">No. HP</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                   id="phone" name="phone" value="{{ old('phone', $user->userable->phone ?? '') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>

        {{-- Ganti Password --}}
        <div class="mb-3">
            <label for="current_password" class="form-label">Password Saat Ini</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                   id="current_password" name="current_password" autocomplete="current-password">
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control"
                   id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
