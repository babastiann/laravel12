@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Ajukan Surat</h3>
    <form action="{{ route('mahasiswa.surat.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jenis_surat" class="form-label">Jenis Surat</label>
            <select name="jenis_surat" class="form-control" required>
                <option value="Pengantar Tugas">Pengantar Tugas</option>
                <option value="Keterangan Lulus">Keterangan Lulus</option>
                <option value="Laporan Hasil Studi">Laporan Hasil Studi</option>
                <option value="Keterangan Mahasiswa Aktif">Keterangan Mahasiswa Aktif</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="detail_surat" class="form-label">Detail Surat</label>
            <textarea name="detail_surat" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>
</div>
@endsection
