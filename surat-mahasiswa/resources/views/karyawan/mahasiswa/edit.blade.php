@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Edit Mahasiswa</h2>
    <form action="{{ route('karyawan.mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nrp">NRP</label>
            <input type="text" name="nrp" class="form-control" value="{{ old('nrp', $mahasiswa->nrp) }}" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $mahasiswa->nama) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $mahasiswa->email) }}" required>
        </div>
        <div class="form-group">
            <label for="prodi">Program Studi</label>
            <input type="text" name="prodi" class="form-control" value="{{ old('prodi', $mahasiswa->prodi) }}" readonly required>
        </div>
        <button type="submit" class="btn btn-primary">Update Mahasiswa</button>
    </form>
</div>
@endsection
