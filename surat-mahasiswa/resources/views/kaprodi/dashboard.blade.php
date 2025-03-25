<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kaprodi</title>
</head>
<body>
    <h2>Selamat datang, {{ Auth::user()->email }}</h2>

    <h3>Informasi Pengguna</h3>
    <ul>
        <li>Email: {{ Auth::user()->email }}</li>
        <li>User ID: {{ Auth::user()->id }}</li>
        <li>Userable ID: {{ Auth::user()->userable_id }}</li>
        <li>Tipe Pengguna: {{ Auth::user()->userable_type }}</li>
    </ul>

    <h3>Menu</h3>
    <ul>
        <li><a href="{{ route('kaprodi.surat.index') }}">Lihat Pengajuan Surat</a></li>
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
