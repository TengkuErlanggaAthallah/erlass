<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="shortcut icon" href="/images/erlass.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Candal&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        :root {
            --background-color: #f0f8ff;
            --header-bg-color: rgba(77, 204, 204, 1);
            --card-bg-color: rgba(179, 229, 252, 0.4);
            --text-color: #333;
            --hover-color: #36a8a8;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-color);
            background-image: url('/images/background-home.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            animation: fadeIn 1s ease-in-out;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .tombol-back {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 100;
            animation: slideIn 1s ease-in;
        }

        .tombol-back a {
            display: inline-block;
            background-color: #4dcccc;
            border-radius: 50%;
            padding: 15px;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .tombol-back a:hover {
            background-color: #36a8a8;
            transform: scale(1.1);
        }

        .tombol-back img {
            width: 75px;
            height: auto;
        }

        .header {
            width: 65%;
            height: 55px;
            background: var(--header-bg-color, #4fc3f7);
            border-radius: 45px;
            border: 1px solid rgba(0, 0, 0, 1);
            text-align: center;
            padding: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            margin: 20px auto 30px;
            font-family: "Candal", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: white; /* Mengubah warna teks menjadi putih */
            text-shadow: 
            1px 1px 0 rgba(0, 0, 0, 1),
            -1px -1px 0 rgba(0, 0, 0, 1),
            1px -1px 0 rgba(0, 0, 0, 1),
            -1px 1px 0 rgba(0, 0, 0, 1);
            margin-bottom: 20px;
            position: relative;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
            position: relative;
        }

        .text-container {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            background-color: var(--card-bg-color);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            flex-wrap: wrap;
            position: relative;
        }

        .text-container img {
            max-width: 400px;
            width: 100%;
            border-radius: 10px;
            margin-right: 20px;
        }

        .text-container div {
            flex: 1;
            min-width: 300px;
            word-wrap: break-word;
            margin: 0;
            text-align: left;
        }

        .text-container p {
            font-size: 20px;
            line-height: 1.8;
            color: var(--text-color);
            margin-top: 10px;
        }

        /* Gambar Download */
        .download-gif {
            position: absolute; /* Posisi absolute untuk menempatkan gambar di pojok */
            bottom: 20px; /* Jarak dari bawah */
            right: 20px; /* Jarak dari kanan */
            width: 50px; /* Ukuran lebar gambar */
            height: auto; /* Otomatis menjaga proporsi */
            cursor: pointer; /* Menambahkan kursor pointer */
        }

        /* Keyframe untuk animasi slide-in */
        @keyframes slideIn {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tombol-back">
            <a href="/produk">
                <img src="/images/back.png" alt="Tombol Back">
            </a>
        </div>

        <div class="content">
            <div class="text-container" id="text-container">
                <h1 class="header">{{ $media->title }}</h1>
                <img alt="{{ $media->title }}" src="{{ asset($media->image) }}" />
                <div>
                    <p>
                        {{ $media->description }}
                        <br/>
                    </p>
                </div>
                <img style="width: 64px; height: 64px; border: 0px; right: 1px;" onclick="downloadContent()" src="../gif/download.gif" alt="Download" class="download-gif">
            </div>
        </div>
    </div>

    <script>
function downloadContent() {
    const content = document.querySelector('.text-container'); // Pilih elemen yang ingin di-capture

    // Sembunyikan gambar download sebelum di-capture
    const downloadImage = document.querySelector('.download-gif');
    downloadImage.style.display = 'none';

    // Simpan background dari body untuk diatur sementara
    const originalBodyBackgroundColor = document.body.style.backgroundColor;
    document.body.style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--background-color');

    html2canvas(content, { willReadFrequently: true }).then(canvas => {
        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/png'); // Ubah canvas ke format gambar
        link.download = 'media_detail.png'; // Nama file yang akan diunduh
        link.click(); // Simulasikan klik pada link untuk memulai unduhan

        // Kembalikan background body ke semula
        document.body.style.backgroundColor = originalBodyBackgroundColor;

        // Tampilkan kembali gambar download
        downloadImage.style.display = 'block';
    }).catch(err => {
        console.error('Terjadi kesalahan saat mendownload:', err);
        // Tampilkan kembali gambar download jika terjadi kesalahan
        downloadImage.style.display = 'block';
    });
}
    </script>
</body>
</html>
