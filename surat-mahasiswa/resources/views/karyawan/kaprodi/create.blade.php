@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Tambah Kaprodi</h2>
    
    <!-- Menampilkan notifikasi jika password tidak cocok -->
    <div id="passwordError" class="alert alert-danger d-none">
        <strong>Error!</strong> Password dan Konfirmasi Password harus sama.
    </div>

    <form action="{{ route('karyawan.kaprodi.store') }}" method="POST" id="kaprodiForm">
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
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
        </div>
        <div class="form-group">
            <label for="prodi">Program Studi</label>
            <input type="text" name="prodi" class="form-control" id="prodi" value="{{ auth()->user()->karyawan->prodi }}" required readonly>
        </div>
        <button type="submit" class="btn btn-primary" id="submitBtn">Tambah Kaprodi</button>
    </form>
</div>

<script>
    document.getElementById('kaprodiForm').addEventListener('submit', function(event) {
        var password = document.getElementById('password').value;
        var passwordConfirmation = document.getElementById('password_confirmation').value;
        var errorMessage = document.getElementById('passwordError');

        // Menyembunyikan pesan error sebelumnya jika ada
        errorMessage.classList.add('d-none');

        if (password !== passwordConfirmation) {
            event.preventDefault();
            errorMessage.classList.remove('d-none');
        }
    });
</script>
@endsection
