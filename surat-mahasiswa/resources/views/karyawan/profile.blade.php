@extends('layouts.index')

@section('content')
<div class="container">
    <h2>My Profile</h2>
    <div class="card p-3">
        <div class="text-center">
            <!-- Foto Profil yang Bisa Diklik untuk Ganti Foto -->
            <img id="profile-photo" 
                 src="{{ asset('storage/profile_photos/' . Auth::user()->photo) }}" 
                 alt="Profile Photo" 
                 class="rounded-circle" 
                 width="200"
                 height="200" 
                 style="cursor: pointer;" 
                 data-bs-toggle="modal" 
                 data-bs-target="#photoModal">

            <!-- Modal Upload Foto -->
            <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="photoModalLabel">Ganti Foto Profil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="uploadPhotoForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Pilih Foto</label>
                                    <input type="file" id="photoInput" name="photo" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Upload Foto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p><strong>NIK:</strong> {{ Auth::user()->userable_id }}</p>
        <p><strong>Nama:</strong> {{ Auth::user()->karyawan->nama }}</p>
        <p><strong>Alamat:</strong> {{ Auth::user()->karyawan->address }}</p>
        <p><strong>No. Telepon:</strong> {{ Auth::user()->karyawan->phone }}</p>
        <p><strong>Prodi:</strong> {{ Auth::user()->karyawan->prodi }}</p>
    </div>
</div>

<!-- AJAX untuk Upload Foto -->
<script>
document.getElementById('uploadPhotoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);

    fetch("{{ route('profile.updatePhoto') }}", {
        method: "POST",
        body: formData
    }).then(response => response.json())
      .then(data => {
        if (data.success) {
            // Perbarui foto profil di halaman My Profile
            document.getElementById('profile-photo').src = data.photo_url;
            
            // Perbarui foto profil di Main Header (misalnya di file layout utama)
            var profileHeaderPhoto = document.querySelector('.main-header-profile-photo');
            if (profileHeaderPhoto) {
                profileHeaderPhoto.src = data.photo_url;
            }

            // Tutup modal setelah upload berhasil
            var photoModal = bootstrap.Modal.getInstance(document.getElementById('photoModal'));
            photoModal.hide();
        } else {
            alert('Gagal mengupload foto.');
        }
    }).catch(error => console.error('Error:', error));
});
</script>

@endsection
