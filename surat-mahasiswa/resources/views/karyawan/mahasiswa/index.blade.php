@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Daftar Mahasiswa</h2>

    <!-- Tombol untuk membuka modal tambah Mahasiswa -->
    <a href="{{ route('karyawan.mahasiswa.create') }}" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMahasiswaModal">Tambah Data Mahasiswa</a>

    <table class="table">
        <thead>
            <tr>
                <th>NRP</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->nrp }}</td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->prodi }}</td>
                    <td>
                        <a href="{{ route('karyawan.mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('karyawan.mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form Tambah Mahasiswa -->
<div class="modal fade" id="tambahMahasiswaModal" tabindex="-1" aria-labelledby="tambahMahasiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        <label for="prodi">Program Studi</label>
                        <input type="text" name="prodi" class="form-control" id="prodi" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
