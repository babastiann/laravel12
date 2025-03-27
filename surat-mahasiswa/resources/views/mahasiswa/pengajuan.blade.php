@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-3">Ajukan Surat</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="nik_kaprodi" value="{{ $kaprodi->nik ?? '' }}">
                <input type="hidden" name="nrp" id="nrp" value="{{ auth()->user()->nrp ?? '' }}">
                <input type="hidden" name="nama" id="nama" value="{{ auth()->user()->nama ?? '' }}">

                <div class="mb-3">
                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                    <select name="jenis_surat" id="jenis_surat" class="form-control" required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        <option value="Keterangan Mahasiswa Aktif">Surat Keterangan Mahasiswa Aktif</option>
                        <option value="Pengantar Tugas">Surat Pengantar Tugas Mata Kuliah</option>
                        <option value="Keterangan Lulus">Surat Keterangan Lulus</option>
                        <option value="Laporan Hasil Studi">Laporan Hasil Studi</option>
                    </select>
                </div>

                <div id="form-nama" class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input required type="text" name="nama" id="nama" class="form-control">
                </div>

                <div id="form-semester" class="mb-3 d-none">
                    <label for="semester" class="form-label">Semester</label>
                    <input required type="number" name="semester" id="semester" class="form-control">
                </div>

                <div id="form-kodeMK" class="mb-3 d-none">
                    <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
                    <input required type="text" name="kode_mk" id="kode_mk" class="form-control">
                </div>

                <div id="form-namaMK" class="mb-3 d-none">
                    <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                    <input required type="text" name="nama_mk" id="nama_mk" class="form-control">
                </div>

                <div id="form-detail" class="mb-3 d-none">
                    <label for="detail_surat" class="form-label">Detail Surat</label>
                    <textarea required name="detail_surat" id="detail_surat" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Surat</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('jenis_surat').addEventListener('change', function () {
        let jenisSurat = this.value;

        document.getElementById('form-semester').classList.add('d-none');
        document.getElementById('form-kodeMK').classList.add('d-none');
        document.getElementById('form-namaMK').classList.add('d-none');
        document.getElementById('form-detail').classList.add('d-none');

        if (jenisSurat === "Keterangan Mahasiswa Aktif") {
            document.getElementById('form-semester').classList.remove('d-none');
            document.getElementById('form-detail').classList.remove('d-none');
        } else if (jenisSurat === "Pengantar Tugas") {
            document.getElementById('form-kodeMK').classList.remove('d-none');
            document.getElementById('form-namaMK').classList.remove('d-none');
            document.getElementById('form-detail').classList.remove('d-none');
        } else if (jenisSurat === "Keterangan Lulus" || jenisSurat === "Laporan Hasil Studi") {
            document.getElementById('form-detail').classList.remove('d-none');
        }
    });
</script>
@endsection
