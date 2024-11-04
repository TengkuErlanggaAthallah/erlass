@extends('layouts.petugas-main')

@section('title', 'Upload Media Petugas')

@section('content')
<main class="app-main"> 
    <div class="app-content-header"> 
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Upload Gambar atau Video</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Upload Media
                        </li>
                    </ol>
                </div>
            </div> 
        </div> 
    </div> 

    {{-- Tampilkan pesan sukses atau error --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    {{-- Form upload untuk petugas --}}
    <div class="container mt-3">
        <form action="{{ route('petugas.upload.media') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="category">Pilih Kategori</label>
                <select id="category" name="category" class="form-control" required onchange="showForm(this.value)">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="motivational_quotes">Motivational Quotes</option>
                    <option value="alat_promosi_internal">Alat Promosi Internal</option>
                    <option value="design_corner">Design Corner</option>
                    <option value="promotion_videos">Promotion Videos</option>
                    <option value="produk">Produk</option>
                </select>
            </div>

            <div id="form-content"></div>

            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </form>
    </div>
</main>

<script>
    function showForm(category) {
        let formContent = '';
        let today = new Date().toISOString().split('T')[0]; // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD

        if (category === 'motivational_quotes') {
            formContent = `
                <div class="form-group">
                    <label for="image">Upload Gambar</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <img id="imagePreview" src="#" alt="Pratinjau Gambar" style="display:none; width: 200px; margin-top: 10px;"/>
                </div>
                <div class="form-group">
                    <label for="quote">Quotes</label>
                    <textarea name="quote" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="upload_date">Tanggal Upload</label>
                    <input type="date" name="upload_date" class="form-control" value="${today}" readonly required>
                </div>
            `;
        } else if (category === 'alat_promosi_internal') {
            formContent = `
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group ">
                    <label for="image">Upload Gambar</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <img id="imagePreview" src="#" alt="Pratinjau Gambar" style="display:none; width: 200px; margin-top: 10px;"/>
                </div>
                <div class="form-group">
                    <label for="upload_date">Tanggal Upload</label>
                    <input type="date" name="upload_date" class="form-control" value="${today}" readonly required>
                </div>
            `;
        } else if (category === 'design_corner') {
            formContent = `
                <div class="form-group">
                    <label for="designer_name">Nama Desainer</label>
                    <input type="text" name="designer_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="upload_date">Tanggal Upload</label>
                    <input type="date" name="upload_date" class="form-control" value="${today}" readonly required>
                </div>
                <div class="form-group">
                    <label for="image">Upload Gambar</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <img id="imagePreview" src="#" alt="Pratinjau Gambar" style="display:none; width: 200px; margin-top: 10px;"/>
                </div>
            `;
        } else if (category === 'promotion_videos') {
            formContent = `
                <div class="form-group">
                    <label for="video_title">Judul</label>
                    <input type="text" name="video_title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="upload_date">Tanggal Upload</label>
                    <input type="date" name="upload_date" class="form-control" value="${today}" readonly required>
                </div>
                <div class="form-group">
                    <label for="thumbnail">Upload Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <img id="imagePreview" src="#" alt="Pratinjau Gambar" style="display:none; width: 200px; margin-top: 10px;"/>
                </div>
                <div class="form-group">
                    <label for="media">Upload Video</label>
                    <input type="file" name="media" class="form-control" accept="video/*" required onchange="previewVideo(event)">
                    <video id="videoPreview" controls style="display:none; width: 200px; margin-top: 10px;">
                        <source id="videoSource" src="#" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            `;
        } else if (category === 'produk') {
            formContent = `
                <div class="form-group">
                    <label for="title">Nama Produk</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="image">Upload Gambar Produk</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <img id="imagePreview" src="#" alt="Pratinjau Gambar" style="display:none; width: 200px; margin-top: 10px;"/>
                </div>
                <div class="form-group">
                    <label for="upload_date">Tanggal Upload</label>
                    <input type="date" name="upload_date" class="form-control" value="${today}" readonly required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
            `;
        }

        document.getElementById('form-content').innerHTML = formContent;
    }

    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block '; // Tampilkan pratinjau gambar
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none'; // Sembunyikan pratinjau jika tidak ada file
        }
    }

    function previewVideo(event) {
        const videoPreview = document.getElementById('videoPreview');
        const videoSource = document.getElementById('videoSource');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                videoSource.src = e.target.result;
                videoPreview.style.display = 'block'; // Tampilkan pratinjau video
                videoPreview.load(); // Muat video baru
            }
            reader.readAsDataURL(file);
        } else {
            videoPreview.style.display = 'none'; // Sembunyikan pratinjau jika tidak ada file
        }
    }
</script>
@endsection
