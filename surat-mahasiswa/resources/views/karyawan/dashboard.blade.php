@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Karyawan</h2>
    <h4>Selamat datang, {{ Auth::user()->email }}</h4>

    <h3>Informasi Pengguna</h3>
    <ul>
        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
        <li><strong>User ID:</strong> {{ Auth::user()->id }}</li>
        <li><strong>Userable ID:</strong> {{ Auth::user()->userable_id }}</li>
        <li><strong>Tipe Pengguna:</strong> {{ Auth::user()->userable_type }}</li>
    </ul>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>

    <hr>

    <h3>Data Mahasiswa</h3>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NRP</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $mhs)
            <tr>
                <td>{{ $mhs->nrp }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->prodi }}</td>
                <td>{{ $mhs->address }}</td>
                <td>{{ $mhs->phone }}</td>
                <td>
                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Data Kaprodi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Alamat</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kaprodi as $kap)
            <tr>
                <td>{{ $kap->nik }}</td>
                <td>{{ $kap->nama }}</td>
                <td>{{ $kap->prodi }}</td>
                <td>{{ $kap->address }}</td>
                <td>{{ $kap->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
