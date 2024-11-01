<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivational Quotes</title>
    <link rel="shortcut icon" href="/images/erlass.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Candal&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
            background-image: url('images/background-home.png'); /* Ganti dengan URL gambar latar belakang Anda */
            background-size: cover; /* Menutupi seluruh area */
            background-position: center; /* Memusatkan gambar */
            background-attachment: fixed; /* Membuat background tidak bergerak saat di-scroll */
            overflow: hidden; /* Mencegah scroll saat animasi berlangsung */
        }
        @keyframes slideInDown {
            0% {
                transform: translateY(-50px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
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
        .header h1 {
            margin: 0;
            font-size: 40px;
            color: #fff;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #00bfff;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }
        .container {
        max-width: 1200px; /* Batasi lebar maksimum container */
        margin: 0 auto; /* Pusatkan container */
        padding: 20px;
    }

    .quotes {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 4 kolom dengan lebar yang sama */
        gap: 20px;
        justify-content: center;
    }

    .quote-card {
        background-color: rgba(179, 229, 252, 0.6);
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .quote-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .quote-card img {
        width: 100%;
        height: 200px; /* Set a fixed height for images */
        object-fit: cover;
        border-radius: 10px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    .quote-card .name {
        font-size: 22px; /* Sedikit lebih kecil agar muat */
        color: #fff;
        margin: 10px 0 5px;
        font-family: "Bree Serif", serif;
        text-shadow: 
            1px 1px 0 black,
            -1px -1px 0 black,
            1px -1px 0 black,
            -1px 1px 0 black;
        flex-grow: 1;
    }

    .icon-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: auto;
    }

    .icon-container img {
        width: 20px; /* Sedikit lebih kecil */
        height: 20px;
        margin-left: 8px;
        cursor: pointer;
    }

    /* Responsive design untuk layar yang lebih kecil */
    @media (max-width: 1200px) {
        .quotes {
            grid-template-columns: repeat(3, 1fr); /* 3 kolom untuk layar medium */
        }
    }

    @media (max-width: 900px) {
        .quotes {
            grid-template-columns: repeat(2, 1fr); /* 2 kolom untuk layar kecil */
        }
    }

    @media (max-width: 600px) {
        .quotes {
            grid-template-columns: 1fr; /* 1 kolom untuk layar sangat kecil */
        }
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

        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.5s, bottom 0.5s;
            z-index: 1000;
            max-width: 90%; /* Batasi lebar maksimum toast */
            text-align: center; /* Center text */
        }

        .toast.show {
            opacity: 1;
            bottom: 40px;
        }

        /* Responsiveness */
        @media (max-width: 600px) {
            .header {
                font-size: 1.5rem; /* Ukuran font lebih kecil di layar kecil */
                padding: 15px; /* Mengurangi padding untuk layar kecil */
            }

            .toast {
                bottom: 10px; /* Mengurangi jarak dari bawah */
                right: 10px; /* Mengurangi jarak dari kanan */
                padding: 8px 16px; /* Mengurangi padding */
                font-size: 14px; /* Ukuran font lebih kecil di layar kecil */
            }
            .tombol-back img {
                width: 40px; /* Ukuran lebih kecil untuk tombol back di layar kecil */
            }
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

        .icon-container img.download-gif {
            width: 24px; /* Atur ukuran sesuai kebutuhan */
            height: auto; /* Pertahankan rasio aspek */
            vertical-align: middle; /* Agar sejajar dengan teks */
        }

        /* Responsiveness */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 90%;
            }
        }
        
        .show {
            opacity: 1;
            transform: translateY(0); /* Kembali ke posisi normal */
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
    <div class="mb-4 tombol-back">
        <a href="/dashboard-user">
            <img src="images/back.png" alt="Tombol Back" />
        </a>
    </div>
    <div class="container" id="quoteContainer">
        <div class="header">
            <h1>Motivational Quotes</h1>
        </div>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterMediaItems()">
        </div>
        <div class="quotes">
            @if ($media->isEmpty())
                <p>Belum ada media yang diupload.</p>
            @else
            @foreach ($media as $item)
            <div class="quote-card">
                    @if($item->is_new) <!-- Periksa apakah item baru -->
                        <div class="media-badge">New</div> <!-- Badge ditampilkan jika item baru -->
                    @endif
                @if($item->image)
                    <img onclick="openModal('{{ $item->image }}')" src="{{ $item->image }}" alt="Quote Image">
                @endif
                <div class="name">{{ $item->quote }}</div>
                <div class="icon-container">
                    <img src="../gif/copy.gif" alt="Copy" class="copy-gif" id="copy-gif" onclick="copyText('{{ $item->quote }}'); event.stopPropagation();" style="cursor: pointer; width: 25px; height: 25px; margin-left: 10px;">
                    @if($item->image)
                        <a href="{{ $item->image }}" download>
                            <img src="../gif/download.gif" alt="Download" class="download-gif" id="download-gif" onclick="event.stopPropagation();">
                        </a>
                    @endif
                </div>                   
            </div>
        @endforeach        
            @endif
        </div>
    </div>
    <div id="toast" class="toast"></div>
        <!-- Modal -->
        <div id="myModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="imgModal">
        </div>
    <script>
        let modalImg = document.getElementById("imgModal");
        let zoomLevel = 1;
                // Menambahkan animasi saat halaman dimuat
                window.onload = function() {
            document.getElementById("quoteContainer").classList.add("show");
            document.body.style.overflow = "auto"; // Mengizinkan scroll setelah animasi
        };

        function filterMediaItems() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.quote-card');
            cards.forEach(card => {
                const quoteText = card.querySelector('.name').innerText.toLowerCase();
                card.style.display = quoteText.includes(input) ? 'flex' : 'none';
            });
        }

        function copyText(text) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    showToast('Text copied to clipboard');
                })
                .catch(err => {
                    console.error('Failed to copy text: ', err);
                });
        }

        function copyText(text) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    showToast('Text copied to clipboard');
                })
                .catch(err => {
                    console.error('Failed to copy text: ', err);
                });
        }

        function showToast(message) {
            var toast = document.getElementById('toast');
            toast.textContent = message;
            toast.className = 'toast show';
            setTimeout(function () {
                toast.className = toast.className.replace('show', '');
            }, 3000);
        }

function openModal(imageSrc) {
            const modal = document.getElementById("myModal");
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

        window.addEventListener('resize', function() {
            if (modalImg.src) {
                adjustImageSize(modalImg);
            }
        });
    </script>
</body>
</html>
