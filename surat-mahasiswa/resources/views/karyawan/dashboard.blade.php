<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan</title>
</head>
<body>
    <h2>Dashboard Karyawan</h2>
    <h2>Selamat datang, {{ Auth::user()->email }}</h2>

    <h3>Informasi Pengguna</h3>
    <ul>
        <li>Email: {{ Auth::user()->email }}</li>
        <li>User ID: {{ Auth::user()->id }}</li>
        <li>Userable ID: {{ Auth::user()->userable_id }}</li>
        <li>Tipe Pengguna: {{ Auth::user()->userable_type }}</li>
    </ul>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <h3>Data Mahasiswa</h3>
    <table border="1">
        <tr>
            <th>NRP</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Alamat</th>
            <th>Telepon</th>
        </tr>
        @foreach($mahasiswa as $mhs)
        <tr>
            <td>{{ $mhs->nrp }}</td>
            <td>{{ $mhs->nama }}</td>
            <td>{{ $mhs->prodi }}</td>
            <td>{{ $mhs->address }}</td>
            <td>{{ $mhs->phone }}</td>
        </tr>
        @endforeach
    </table>

    <h3>Data Kaprodi</h3>
    <table border="1">
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Alamat</th>
            <th>Telepon</th>
        </tr>
        @foreach($kaprodi as $kap)
        <tr>
            <td>{{ $kap->nik }}</td>
            <td>{{ $kap->nama }}</td>
            <td>{{ $kap->prodi }}</td>
            <td>{{ $kap->address }}</td>
            <td>{{ $kap->phone }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
