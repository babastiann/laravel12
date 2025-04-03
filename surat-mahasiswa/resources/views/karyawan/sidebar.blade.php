<ul class="nav">
    <li class="nav-item">
        <a href="{{ route('karyawan.dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    
    <!-- Link untuk Menambah Kaprodi -->
    <li class="nav-item">
        <a href="{{ route('karyawan.kaprodi.index') }}" class="nav-link">
            <i class="fas fa-user-plus"></i>
            <p>Tambah Kaprodi</p>
        </a>
    </li>

    <!-- Link untuk Menambah Mahasiswa -->
    <li class="nav-item">
        <a href="{{ route('karyawan.mahasiswa.index') }}" class="nav-link">
            <i class="fas fa-user-plus"></i>
            <p>Tambah Mahasiswa</p>
        </a>
    </li>
</ul>
