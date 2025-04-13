@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Edit Kaprodi</h2>
    <form action="{{ route('karyawan.kaprodi.update', $kaprodi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik', $kaprodi->nik) }}" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $kaprodi->nama) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $kaprodi->email) }}" required>
        </div>
        <div class="form-group">
            <label for="prodi">Program Studi</label>
            <input type="text" name="prodi" class="form-control" value="{{ old('prodi', $kaprodi->prodi) }}" required readonly>
        </div>
        <button type="submit" class="btn btn-primary">Update Kaprodi</button>
    </form>
</div>
@endsection
