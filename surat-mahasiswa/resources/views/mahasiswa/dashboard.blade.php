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
    <td>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalSurat{{ $s->id_surat }}">
            {{ $s->jenis_surat }}
        </a>
    </td>
    <td>{{ $s->created_at->format('Y-m-d') }}</td>
    <td>
        <span class="badge
            @if ($s->status_surat == 'diterima') bg-success
            @elseif ($s->status_surat == 'ditolak') bg-danger
            @elseif ($s->status_surat == 'diproses') bg-warning
            @else bg-secondary
            @endif">
            {{ ucfirst($s->status_surat) }}
        </span>
    </td>
    <td>
        @if (!empty($s->file_surat) && file_exists(public_path('surat/' . $s->file_surat)))
        <a href="{{ route('surat.download', ['id' => $s->id_surat]) }}" class="btn btn-success btn-sm">Unduh</a>
        @elseif ($s->status_surat == 'ditolak')
        <span class="btn btn-danger btn-sm">Ditolak</span>
        @else
        <button class="btn btn-secondary btn-sm" disabled>Menunggu</button>
        @endif
    </td>
</tr>

<!-- Modal -->
<div class="modal fade" id="modalSurat{{ $s->id_surat }}" tabindex="-1" aria-labelledby="modalLabel{{ $s->id_surat }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel{{ $s->id_surat }}">Detail Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Jenis Surat:</strong> {{ $s->jenis_surat }}</li>
            <li class="list-group-item"><strong>Tanggal Surat:</strong> {{ $s->tanggal_surat }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($s->status_surat) }}</li>
            <li class="list-group-item"><strong>Nama Mahasiswa:</strong> {{ $s->nama }}</li>
            <li class="list-group-item"><strong>NRP:</strong> {{ $s->nrp_mahasiswa }}</li>
            <li class="list-group-item"><strong>Semester:</strong> {{ $s->semester ?? '-' }}</li>
            <li class="list-group-item"><strong>Kode MK:</strong> {{ $s->kode_mk ?? '-' }}</li>
            <li class="list-group-item"><strong>Nama MK:</strong> {{ $s->nama_mk ?? '-' }}</li>
            <li class="list-group-item"><strong>Detail Surat:</strong><br>{{ $s->detail_surat }}</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
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
