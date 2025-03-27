@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h3>Dashboard Mahasiswa</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Daftar Surat yang Diajukan</h4>

            @if($surat->count() > 0)
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->jenis_surat }}</td>
                            <td>{{ $s->created_at->format('Y-m-d') }}</td>
                            <td>
                                <span class="badge
                                    @if ($s->status_surat == 'Disetujui') bg-success
                                    @elseif ($s->status_surat == 'Ditolak') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ $s->status_surat }}
                                </span>
                            </td>
                            <td>
                                @if ($s->status_surat == 'Disetujui')
                                    <a href="{{ route('surat.download', $s->id) }}" class="btn btn-success btn-sm">Unduh</a>
                                @elseif ($s->status_surat == 'Ditolak')
                                    <a href="{{ route('surat.show', $s->id) }}" class="btn btn-warning btn-sm">Lihat Alasan</a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Menunggu</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-muted">Belum ada pengajuan surat.</p>
            @endif
        </div>
    </div>
</div>
@endsection
