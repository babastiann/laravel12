@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h3>Dashboard Kaprodi</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Daftar Surat yang Diajukan</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Mahasiswa</th>
                        <th>Jenis Surat</th>
                        <th>Keterangan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surat as $s)
                    @dd($s) <!-- Debugging untuk melihat isi objek $s -->
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->mahasiswa ? $s->mahasiswa->nama : 'Data tidak tersedia' }}</td>
                        <td>{{ $s->jenis_surat }}</td>
                        <td>{{ $s->detail_surat }}</td>
                        <td>{{ $s->created_at->format('Y-m-d') }}</td>
                        <td>
                            <span class="badge
                                @if ($s->status_surat == 'diterima') bg-success
                                @elseif ($s->status_surat == 'ditolak') bg-danger
                                @else bg-secondary
                                @endif">
                                {{ $s->status_surat }}
                            </span>
                        </td>
                        <td>
                            @if ($s->status_surat == 'diajukan')
                                <!-- Tombol Setujui -->
                                <form action="{{ route('kaprodi.surat.approve', ['id' => $s->id_surat]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>

                                <!-- Tombol Tolak -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $s->id_surat }}">
                                    Tolak
                                </button>

                                <!-- Modal untuk Menolak Surat -->
                                <div class="modal fade" id="rejectModal{{ $s->id_surat }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel">Tolak Surat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('kaprodi.surat.reject', ['id' => $s->id_surat]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Tolak Surat</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted">Tidak ada aksi</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
