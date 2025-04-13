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
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $s->mahasiswa ? $s->mahasiswa->nama : 'Data tidak tersedia' }}</td>
    <td>
        <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $s->id_surat }}">
            {{ $s->jenis_surat }}
        </a>
    </td>
    <td>{{ Str::limit($s->detail_surat, 50) }}</td>
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
        @else
            <span class="text-muted">Tidak ada aksi</span>
        @endif
    </td>
</tr>

<!-- Modal Detail Surat -->
<div class="modal fade" id="detailModal{{ $s->id_surat }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $s->id_surat }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel{{ $s->id_surat }}">Detail Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nama Mahasiswa:</strong> {{ $s->mahasiswa ? $s->mahasiswa->nama : '-' }}</li>
            <li class="list-group-item"><strong>NRP:</strong> {{ $s->nrp_mahasiswa }}</li>
            <li class="list-group-item"><strong>Jenis Surat:</strong> {{ $s->jenis_surat }}</li>
            <li class="list-group-item"><strong>Tanggal Surat:</strong> {{ $s->tanggal_surat }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($s->status_surat) }}</li>
            <li class="list-group-item"><strong>Keterangan:</strong><br>{{ $s->detail_surat }}</li>
            <li class="list-group-item"><strong>Semester:</strong> {{ $s->semester ?? '-' }}</li>
            <li class="list-group-item"><strong>Kode MK:</strong> {{ $s->kode_mk ?? '-' }}</li>
            <li class="list-group-item"><strong>Nama MK:</strong> {{ $s->nama_mk ?? '-' }}</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tolak Surat -->
<div class="modal fade" id="rejectModal{{ $s->id_surat }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $s->id_surat }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rejectModalLabel{{ $s->id_surat }}">Tolak Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menolak surat <strong>{{ $s->jenis_surat }}</strong> dari <strong>{{ $s->mahasiswa ? $s->mahasiswa->nama : '-' }}</strong>?</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('kaprodi.surat.reject', ['id' => $s->id_surat]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Ya, Tolak</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
