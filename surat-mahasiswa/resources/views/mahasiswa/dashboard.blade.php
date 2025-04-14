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
                                @if (!empty($s->file_surat) && file_exists(storage_path('app/public/surat/' . $s->file_surat)))
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
      <div class="modal-content shadow-lg border-0 rounded-4">
        <div class="modal-header bg-primary text-white rounded-top-4">
          <h5 class="modal-title" id="modalLabel{{ $s->id_surat }}"><i class="bi bi-file-earmark-text"></i> Detail Surat</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row g-3">
              <div class="col-md-6">
                  <p><strong>Jenis Surat:</strong><br> {{ $s->jenis_surat }}</p>
                  <p><strong>Tanggal Surat:</strong><br> {{ $s->tanggal_surat }}</p>
                  <p><strong>Status:</strong><br> <span class="badge 
                      @if ($s->status_surat == 'diterima') bg-success
                      @elseif ($s->status_surat == 'ditolak') bg-danger
                      @elseif ($s->status_surat == 'diproses') bg-warning
                      @else bg-secondary
                      @endif">{{ ucfirst($s->status_surat) }}</span></p>
                  <p><strong>Detail Surat:</strong><br>{{ $s->detail_surat }}</p>
              </div>
              <div class="col-md-6">
                  <p><strong>Nama Mahasiswa:</strong><br> {{ $s->nama }}</p>
                  <p><strong>NRP:</strong><br> {{ $s->nrp_mahasiswa }}</p>
                  <p><strong>Semester:</strong><br> {{ $s->semester ?? '-' }}</p>
                  <p><strong>Kode MK:</strong><br> {{ $s->kode_mk ?? '-' }}</p>
                  <p><strong>Nama MK:</strong><br> {{ $s->nama_mk ?? '-' }}</p>
              </div>
          </div>
        </div>
        <div class="modal-footer bg-light rounded-bottom-4">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              <i class="bi bi-x-circle"></i> Tutup
          </button>
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
