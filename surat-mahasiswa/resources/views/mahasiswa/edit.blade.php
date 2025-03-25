@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Mahasiswa</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">NRP</label>
            <input type="text" name="nrp" class="form-control" value="{{ $mahasiswa->nrp }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prodi</label>
            <input type="text" name="prodi" class="form-control" value="{{ $mahasiswa->prodi }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control">{{ $mahasiswa->address }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ $mahasiswa->phone }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('karyawan.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
