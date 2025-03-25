@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Verifikasi Pengajuan Surat</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mahasiswa</th>
                <th>Jenis Surat</th>
                <th>Detail</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $s)
            <tr>
                <td>{{ $s->mahasiswa ? $s->mahasiswa->nrp : '-' }}</td>
                <td>{{ $s->jenis_surat }}</td>
                <td>{{ $s->detail_surat }}</td>
                <td>
                    <form action="{{ route('kaprodi.surat.approve', $s->id_surat) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                    </form>
                    <form action="{{ route('kaprodi.surat.reject', $s->id_surat) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
