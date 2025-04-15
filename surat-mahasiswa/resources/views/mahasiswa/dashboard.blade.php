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
                            <th>Kelola</th> <!-- Kolom baru -->
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
                                    <a href="{{ route('surat.download', ['id' => $s->id_surat]) }}" class="btn btn-success btn-sm mb-1">Unduh</a>
                                @elseif (empty($s->file_surat))
                                    <button class="btn btn-secondary btn-sm" disabled>Menunggu</button>
                                @endif
                            </td>
                            <td>
                                @if ($s->status_surat == 'diajukan')
                                    <a href="{{ route('surat.edit', $s->id_surat) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                                    <form action="{{ route('surat.destroy', $s->id_surat) }}" method="POST" style="display:inline;" class="form-delete d-inline" data-nama="{{ $s->jenis_surat }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Hapus Surat -->
                        <div class="modal fade" id="hapusModal{{ $s->id_surat }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $s->id_surat }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content rounded-4 shadow-lg">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="hapusModalLabel{{ $s->id_surat }}">
                                            <i class="bi bi-trash"></i> Konfirmasi Hapus Surat
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus surat ini? Proses ini tidak dapat dibatalkan.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('surat.destroy', $s->id_surat) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.form-delete');

        deleteForms.forEach(function(form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const nama = form.getAttribute('data-nama');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Data surat "${nama}" akan dihapus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
