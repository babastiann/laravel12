@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h3>Dashboard Karyawan - Upload Surat</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Surat yang Harus Diupload</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Mahasiswa</th>
                        <th>Jenis Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surat as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->mahasiswa->nama }}</td>
                        <td>{{ $s->jenis_surat }}</td>
                        <td>
                            <form action="{{ route('karyawan.upload', ['id' => $s->id_surat]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file_surat" class="form-control" required>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Upload</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
