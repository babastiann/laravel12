@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Daftar Pengajuan Surat</h3>

    <div class="d-flex mb-3">
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary me-2">Kembali ke Dashboard</a>
        <a href="{{ route('mahasiswa.surat.create') }}" class="btn btn-primary">Ajukan Surat</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis Surat</th>
                <th>Detail</th>
                <th>Status</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $s)
            <tr>
                <td>{{ $s->jenis_surat }}</td>
                <td>{{ $s->detail_surat }}</td>
                <td>
                    <span class="badge bg-{{ $s->status_surat == 'diterima' ? 'success' : ($s->status_surat == 'ditolak' ? 'danger' : 'warning') }}">
                        {{ ucfirst($s->status_surat) }}
                    </span>
                </td>
                <td>
                    @if($s->file_surat)
                        <a href="{{ asset('storage/' . $s->file_surat) }}" class="btn btn-success btn-sm" target="_blank">Download</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
