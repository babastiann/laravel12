@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-3">Edit Surat</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('surat.update', $surat->id_surat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="nik_kaprodi" value="{{ $surat->nik_kaprodi }}">
                <input type="hidden" name="nrp" value="{{ $surat->nrp }}">
                <input type="hidden" name="nama" value="{{ $surat->nama }}">

                <div class="mb-3">
                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                    <select name="jenis_surat" id="jenis_surat" class="form-control">
                        <option value="">-- Pilih Jenis Surat --</option>
                        <option value="Keterangan Mahasiswa Aktif" {{ $surat->jenis_surat == 'Keterangan Mahasiswa Aktif' ? 'selected' : '' }}>Surat Keterangan Mahasiswa Aktif</option>
                        <option value="Pengantar Tugas" {{ $surat->jenis_surat == 'Pengantar Tugas' ? 'selected' : '' }}>Surat Pengantar Tugas Mata Kuliah</option>
                        <option value="Keterangan Lulus" {{ $surat->jenis_surat == 'Keterangan Lulus' ? 'selected' : '' }}>Surat Keterangan Lulus</option>
                        <option value="Laporan Hasil Studi" {{ $surat->jenis_surat == 'Laporan Hasil Studi' ? 'selected' : '' }}>Laporan Hasil Studi</option>
                    </select>
                </div>

                <div id="form-semester" class="mb-3 d-none">
                    <label for="semester" class="form-label">Semester</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="">-- Pilih Semester --</option>
                        <option value="Ganjil" {{ $surat->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ $surat->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>

                <div id="form-kodeMK" class="mb-3 d-none">
                    <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
                    <input type="text" name="kode_mk" id="kode_mk" class="form-control" value="{{ old('kode_mk', $surat->kode_mk) }}">
                </div>

                <div id="form-namaMK" class="mb-3 d-none">
                    <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" id="nama_mk" class="form-control" value="{{ old('nama_mk', $surat->nama_mk) }}">
                </div>

                <div id="form-detail" class="mb-3 d-none">
                    <label for="detail_surat" class="form-label">Detail Surat</label>
                    <textarea name="detail_surat" id="detail_surat" class="form-control" rows="3">{{ old('detail_surat', $surat->detail_surat) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Surat</button>
            </form>
        </div>
    </div>
</div>

<script>
    let jenisSurat = "{{ $surat->jenis_surat }}";

    document.addEventListener('DOMContentLoaded', function () {
        const semester = document.getElementById('form-semester');
        const kodeMK = document.getElementById('form-kodeMK');
        const namaMK = document.getElementById('form-namaMK');
        const detail = document.getElementById('form-detail');

        if (jenisSurat === "Keterangan Mahasiswa Aktif") {
            semester.classList.remove('d-none');
            detail.classList.remove('d-none');
        } else if (jenisSurat === "Pengantar Tugas") {
            kodeMK.classList.remove('d-none');
            namaMK.classList.remove('d-none');
            detail.classList.remove('d-none');
        } else if (jenisSurat === "Keterangan Lulus" || jenisSurat === "Laporan Hasil Studi") {
            detail.classList.remove('d-none');
        }
    });
</script>
@endsection
