@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Penerbitan Surat</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mahasiswa</th>
                <th>Jenis Surat</th>
                <th>Detail</th>
                <th>Upload Surat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $s)
            <tr>
                <td>{{ $s->mahasiswa->nrp }}</td>
                <td>{{ $s->jenis_surat }}</td>
                <td>{{ $s->detail_surat }}</td>
                <td>
                    <form action="{{ route('karyawan.surat.issue', $s->id_surat) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file_surat" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
