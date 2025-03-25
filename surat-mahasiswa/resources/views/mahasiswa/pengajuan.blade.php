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

            <pre>
                nrp_mahasiswa: {{ auth()->user()->userable->nrp ?? 'Tidak ada' }} <br>
                nik_kaprodi: {{ isset($kaprodi) ? $kaprodi->nik : 'Tidak ada' }}
            </pre>
            
            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Input Hidden untuk nik_kaprodi -->
                <input type="hidden" name="nik_kaprodi" value="{{ $kaprodi->nik ?? '' }}">

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

                <div class="mb-3">
                    <label for="detail_surat" class="form-label">Detail Surat</label>
                    <textarea name="detail_surat" id="detail_surat" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Surat</button>
            </form>
        </div>
    </div>
</div>
@endsection
