@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Tambah Kaprodi</h2>
    <form action="{{ route('karyawan.kaprodi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="form-group">
            <label for="prodi">Program Studi</label>
            <input type="text" name="prodi" class="form-control" id="prodi" value="{{ auth()->user()->karyawan->prodi }}" required readonly>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Kaprodi</button>
    </form>
</div>
@endsection
