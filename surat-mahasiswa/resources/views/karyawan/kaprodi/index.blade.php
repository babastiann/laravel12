@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Daftar Kaprodi - Prodi {{ auth()->user()->prodi }}</h2>
    
    <!-- Tombol untuk menampilkan form -->
    <a href="{{ route('karyawan.kaprodi.create') }}" class="btn btn-primary mb-3">Tambah Data Kaprodi</a>

    <table class="table">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kaprodis as $kaprodi)
                <tr>
                    <td>{{ $kaprodi->nik }}</td>
                    <td>{{ $kaprodi->nama }}</td>
                    <td>{{ $kaprodi->prodi }}</td>
                    <td>
                        <a href="{{ route('karyawan.kaprodi.edit', $kaprodi->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('karyawan.kaprodi.destroy', $kaprodi->id) }}" method="POST" style="display:inline;" class="form-delete d-inline" data-nama="{{ $kaprodi->nama }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form Tambah Kaprodi -->
<div class="modal fade" id="tambahKaprodiModal" tabindex="-1" aria-labelledby="tambahKaprodiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKaprodiModalLabel">Tambah Kaprodi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahKaprodiForm" action="{{ route('karyawan.kaprodi.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <!-- Kolom prodi dihilangkan karena akan diambil otomatis dari auth()->user()->prodi -->
                    <button type="submit" class="btn btn-primary">Tambah Kaprodi</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
                    text: `Data kaprodi "${nama}" akan dihapus!`,
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
@endsection
