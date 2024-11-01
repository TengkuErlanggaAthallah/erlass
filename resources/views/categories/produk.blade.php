<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="shortcut icon" href="/images/erlass.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Candal&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <style>
        :root {
            --background-color: #f0f8ff;
            --header-bg-color: rgba(77, 204, 204, 1);
            --card-bg-color: rgba(179, 229, 252, 0.4);
            --text-color: #fff;
            --hover-color: #36a8a8;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-color);
            background-image: url('images/background-home.png'); /* Ganti dengan URL gambar latar belakang Anda */
            background-size: cover; /* Menutupi seluruh area */
            background-position: center; /* Memusatkan gambar */
            background-attachment: fixed; /* Membuat background tidak bergerak saat di-scroll */
            margin: 0;
            padding: 0;
            opacity: 0;
            transition: opacity 1s ease-in;
        }

        body.loaded {
            opacity: 1;
        }

        .header.show {
            opacity: 1;
            transform: translateY(0);
        }

        .header h1 {
            font-size: 40px;
            margin: 0;
        }

        .card {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 0; /* Tambahkan margin atas dan bawah */
        }

        .media-item {
            background-color: var(--card-bg-color);
            border-radius: 10px;
            width: 300px;
            margin: 15px; /* Mengubah margin untuk lebih baik */
            padding: 15px; /* Menambahkan padding */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Bayangan lebih halus */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: scale(0.9);
            transition: transform 0.6s ease-in, opacity 0.6s ease-in;
        }

        /* Efek saat media-item muncul */
        .media-item.show {
            opacity: 1;
            transform: scale(1);
        }

        .media-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3); /* Menambahkan bayangan lebih dalam saat hover */
        }
        .media-item img {
            width: 100%;
            height: 200px; /* Tetapkan tinggi tetap untuk gambar */
            object-fit: contain; /* Pastikan gambar tidak terpotong dan tetap dalam rasio aspeknya */
            cursor: pointer;
            border: 2px solid #ffffff; /* Garis tepi putih pada gambar */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Bayangan gambar */
            border-radius: 10px;
        }

        .media-item .name {
            font-family: "Bree Serif", serif;
            font-size: 22px; /* Ukuran font lebih besar */
            font-weight: bold; /* Membuat nama lebih menonjol */
            margin: 10px 0 5px; /* Margin atas dan bawah untuk nama */
            color: #222; /* Warna teks lebih gelap untuk kontras */
            font-family: "Bree Serif", serif;
        }

        .media-item .description {
            font-family: "Bree Serif", serif;
            font-size: 20px;
            color: #333; /* Warna teks deskripsi lebih gelap */
            margin-bottom: 10px; /* Menambahkan jarak bawah untuk deskripsi */
            font-family: "Bree Serif", serif;
        }

        .media-footer {
            display: flex;
            justify-content: end;
            align-items: center;
            margin-top: 10px;
            height: 25px;
        }

        .media-footer .date {
            color: var(--text-color);
            font-size: 12px; /* Ukuran font untuk tanggal lebih kecil */
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .close:hover {
            color: #bbb;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            overflow: auto;
        }

        .modal-content {
            display: block;
            margin: auto;
            max-width: 90%;
            max-height: 90vh;
            object-fit: contain;
        }

        /* Responsiveness */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 90%;
            }
        }

        .header {
            color: white; 
            width: 90%; /* Menggunakan lebar responsif */
            max-width: 600px; /* Lebar maksimum untuk header */
            height: auto; /* Biarkan tinggi otomatis */
            background: #4db6ac;
            border: 1px solid rgba(0, 0, 0, 1);
            border-radius: 45px;
            text-align: center;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            font-family: "Candal", sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto; /* Margin otomatis untuk center */
            animation: slideInDown 0.8s ease-out;
            text-shadow: 
            1px 1px 0 rgba(0, 0, 0, 1),
            -1px -1px 0 rgba(0, 0, 0, 1),
            1px -1px 0 rgba(0, 0, 0, 1),
            -1px 1px 0 rgba(0, 0, 0, 1),
            0 1px 0 rgba(0, 0, 0, 1),
            0 -1px 0 rgba(0, 0, 0, 1);
        }

        .tombol-back {
            position: absolute; /* Ubah ke fixed agar tetap di satu posisi */
            top: 20px; /* Sesuaikan posisi atas */
            left: 20px; /* Sesuaikan posisi kiri */
            z-index: 100; /* Pastikan berada di atas elemen lain */
            animation: slideIn 1s ease-in;
        }

        .tombol-back a {
            display: inline-block;
            background-color: #4dcccc;
            border-radius: 50%;
            padding: 10px; /* Mengurangi padding untuk responsivitas */
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .tombol-back a:hover {
            background-color: #36a8a8;
            transform: scale(1.1);
        }

        .tombol-back img {
            width: 50px; /* Menyesuaikan ukuran tombol back */
            height: auto; /* Biarkan tinggi otomatis */
        }

        /* Responsiveness */
        @media only screen and (max-width: 600px) {
            .header {
                font-size: 1.5rem; /* Ukuran font lebih kecil di layar kecil */
                padding: 15px; /* Mengurangi padding untuk layar kecil */
            }

            .tombol-back img {
                width: 40px; /* Ukuran lebih kecil untuk tombol back di layar kecil */
            }
        }

        .media-badge {
            position: absolute; /* Mengatur posisi badge */
            top: 10px;
            left: 10px;
            background-color: rgba(255, 165, 0, 0.8); /* Warna latar belakang badge */
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); /* Bayangan badge */
            transition: transform 0.3s, opacity 0.3s; /* Tambahkan transisi untuk efek halus */
            opacity: 0; /* Sembunyikan badge secara default */
            visibility: hidden; /* Sembunyikan badge secara default */
        }

        .media-item:hover .media-badge {
            opacity: 1; /* Tampilkan badge saat hover */
            visibility: visible; /* Tampilkan badge saat hover */
            transform: scale(1.1); /* Efek zoom saat hover */
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .search-container input {
            width: 100%; /* Mengatur lebar penuh untuk .search-input dan lebar penuh untuk input dalam .search-container */
            max-width: 150px; /* Mengatur lebar maksimum untuk input dalam .search-container */
            padding: 10px; /* Memberikan ruang di dalam input */
            border: 2px solid #4dcccc; /* Warna border biru */
            border-radius: 5px; /* Membuat sudut membulat */
            font-size: 16px; /* Ukuran font */
            transition: border-color 0.3s ease; /* Transisi halus untuk perubahan border */
            justify-content: center; /* Penempatan konten di tengah */
        }

        .search-container input:focus {
            outline: none; /* Menghilangkan outline default */
            border-color: #36a8a8; /* Warna border saat fokus */
            box-shadow: 0 0 5px rgba(54, 168, 168, 0.5); /* Efek bayangan saat fokus */
        }

        .search-container input::placeholder {
            color: #a0a0a0; /* Warna placeholder */
            opacity: 1; /* Pastikan placeholder terlihat */
        }

        .search-container {
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <div class="tombol-back">
            <a href="/dashboard-user">
                <img src="images/back.png" alt="Tombol Back">
            </a>
        </div>
        <div class="header">
            <h1>Product</h1>
        </div>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterMediaItems()">
        </div>
    </header>

    <main>
        <div class="card">
            @if(isset($media) && $media->count())
                @foreach($media as $item)
                    <div class="media-item" onclick="goToPage('{{ route('categories.detail', $item->id) }}')"> <!-- Pindah halaman saat klik card -->
                        @if($item->is_new)
                            <div class="media-badge">New</div>
                        @endif
                        @if($item->image)
                            <!-- Tambahkan event stopPropagation di gambar -->
                            <img src="{{ $item->image }}" alt="Image" onclick="openModal('{{ $item->image }}'); event.stopPropagation();">
                        @endif
                        <p class="name">{{ $item->title }}</p>
                        <div class="media-footer">
                            <a href="{{ $item->image }}" download onclick="event.stopPropagation();"> <!-- Stop propagation untuk download -->
                                <img style="width: 24px; height: 24px; border: 0px" src="../gif/download.gif" alt="Download" class="download-gif">
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada media yang tersedia.</p>
            @endif
        </div>
    </main>
    
    <!-- Modal -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="imgModal">
    </div>
    
    <script>
        let modalImg = document.getElementById("imgModal");
        let zoomLevel = 1;
        
        function goToPage(url) {
            window.location.href = url;
        }
        
        function filterMediaItems() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const mediaItems = document.querySelectorAll('.media-item');

            mediaItems.forEach(item => {
                const name = item.querySelector('.name').textContent.toLowerCase();
                // Show or hide the media item based on the search query
                if (name.includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }
    
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
            const header = document.querySelector('.header');
            header.classList.add('show');
            const mediaItems = document.querySelectorAll('.media-item');
            mediaItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('show');
                }, 200 * index);
            });
        });
    
        function openModal(imageSrc) {
            const modal = document.getElementById("myModal");
            const modalImg = document.getElementById("imgModal");
            modal.style.display = "flex";
            modalImg.src = imageSrc;
            
            modalImg.onload = function() {
                adjustImageSize(this);
            }
        }
    
        function adjustImageSize(img) {
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;
            const imageRatio = img.naturalWidth / img.naturalHeight;
            const windowRatio = windowWidth / windowHeight;
    
            if (imageRatio > windowRatio) {
                if (img.naturalWidth > windowWidth * 0.9) {
                    img.style.width = '90%';
                    img.style.height = 'auto';
                } else {
                    img.style.width = 'auto';
                    img.style.height = 'auto';
                }
            } else {
                if (img.naturalHeight > windowHeight * 0.9) {
                    img.style.height = '90vh';
                    img.style.width = 'auto';
                } else {
                    img.style.width = 'auto';
                    img.style.height = 'auto';
                }
            }
        }
    
        window.addEventListener('resize', function() {
            const modalImg = document.getElementById("imgModal");
            if (modalImg.src) {
                adjustImageSize(modalImg);
            }
        });
    
        function closeModal() {
            const modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    
        function zoomImage(event, zoomIn = true) {
            const factor = zoomIn ? 1.1 : 0.9;
            const newWidth = modalImg.width * factor;
            const newHeight = modalImg.height * factor;
            modalImg.style.width = newWidth + 'px';
            modalImg.style.height = newHeight + 'px';
        }
    
        document.getElementById("myModal").addEventListener('wheel', function(e) {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomImage(e, true);
            } else {
                zoomImage(e, false);
            }
        });
    </script>    
</body>
</html>
