@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Tambah Mahasiswa</h2>
    <form action="{{ route('karyawan.mahasiswa.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nrp">NRP</label>
            <input type="text" name="nrp" class="form-control" id="nrp" required>
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
            <input type="text" name="prodi" class="form-control" id="prodi" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
    </form>
</div>
@endsection
