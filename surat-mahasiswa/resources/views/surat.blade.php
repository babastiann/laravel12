@extends('layouts.app')

@section('title', 'Ajukan Surat')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Form Pengajuan Surat</h2>
    <form action="{{ route('surat.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="jenis_surat" class="block text-sm font-medium text-gray-700">Jenis Surat</label>
            <select name="jenis_surat" id="jenis_surat" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="Pengantar Tugas">Pengantar Tugas</option>
                <option value="Keterangan Lulus">Keterangan Lulus</option>
                <option value="Laporan Hasil Studi">Laporan Hasil Studi</option>
                <option value="Keterangan Mahasiswa Aktif">Keterangan Mahasiswa Aktif</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="detail_surat" class="block text-sm font-medium text-gray-700">Detail Surat</label>
            <textarea name="detail_surat" id="detail_surat" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ajukan Surat</button>
        </div>
    </form>
</div>
@endsection

