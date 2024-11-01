<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion Videos</title>
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
            background-image: url('images/background-home.png');
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

                /* Animations */
                @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .header h1 {
            font-size: 40px;
            margin: 0;
        }

        /* Card Styling */
/* Card Styling */
.card {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.video-container {
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap to the next line */
    justify-content: center; /* Center items horizontally */
}

.media-item {
    background-color: var(--card-bg-color);
    border-radius: 10px;
    width: calc(25% - 20px); /* This allows 4 items per row with some margin */
    margin: 10px;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease;
    animation: fadeIn 0.8s ease-in-out;
    margin-top: 50px;
}

.media-item:hover {
    transform: scale(1.05);
}

.media-item video {
    width: 100%;
    border-radius: 10px;
    max-height: 200px;
    object-fit: cover;
    cursor: pointer;
    transition: opacity 0.2s ease-in-out;
}

/* Responsive Design */
@media (max-width: 800px) {
    .media-item {
        width: calc(50% - 20px); /* 2 items per row on smaller screens */
    }
}

@media (max-width: 500px) {
    .media-item {
        width: calc(100% - 20px); /* 1 item per row on very small screens */
    }
}

        .media-item .name, .media-item .date {
            font-size: 14px;
            color: #fff;
            font-family: "Konkhmer Sleokchher", system-ui;
            text-shadow: 
            1px 1px 0 black,
            -1px -1px 0 black,
            1px -1px 0 black,
            -1px 1px 0 black;
        }

        /* Back Button Styling */
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

        /* Modal Styling (if used) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            width: 60%;
            max-height: 80%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.3s ease;
            cursor: grab;
        }

        /* Responsiveness */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 90%;
            }
        }
        .media-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 165, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, opacity 0.3s;
            opacity: 0;
            visibility: hidden;
        }

        .media-item:hover .media-badge {
            opacity: 1;
            visibility: visible;
            transform: scale(1.1);
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
    <div class="tombol-back">
        <a href="/dashboard-user" aria-label="Kembali ke Dashboard">
            <img src="images/back.png" alt="Tombol Back">
        </a>
    </div>
    <header>
        <div class="header">
            <h1>Promosi Video</h1>
        </div>
        <div class="search-container">
            <input type="text" id="videoSearch" class="search-input" placeholder="Cari video...">
        </div>
    </header>

    <main>
        <div class="card">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    
            <div class="video-container media-container">
                @foreach($media as $item)
                @if($item->media && in_array(pathinfo($item->media, PATHINFO_EXTENSION), ['mp4', 'mkv', 'avi']))
                <div class="media-item">
                    @if($item->is_new)
                        <div class="media-badge">New</div>
                    @endif
                    <img src="{{ $item->thumbnail }}" alt="Thumbnail" class="video-thumbnail" style="cursor: pointer; border-radius: 10px; width: 100%; max-height: 200px; object-fit: cover;">
                    <video controls style="display: none;">
                        <source src="{{ $item->media }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <p class="name">{{ $item->video_title }}</p>
                </div>
                @else
                <div class="media-item">
                    <p>Video tidak dapat diputar.</p>
                </div>
                @endif
            @endforeach
            </div>
        </div>
    </main>
    <script>
                document.getElementById('videoSearch').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const videoItems = document.querySelectorAll('.media-item');

            videoItems.forEach(item => {
                const title = item.querySelector('.name').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    item.style.display = ''; // Show item
                } else {
                    item.style.display = 'none'; // Hide item
                }
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
    const videoItems = document.querySelectorAll('.media-item');

    videoItems.forEach(item => {
        const video = item.querySelector('video');
        const thumbnail = item.querySelector('.video-thumbnail');

        // Mute video to ensure it can autoplay
        video.muted = true;

        // Show the thumbnail and hide the video initially
        thumbnail.style.display = 'block';
        video.style.display = 'none';

        // Add click event to the thumbnail
        thumbnail.addEventListener('click', () => {
            thumbnail.style.display = 'none'; // Hide thumbnail
            video.style.display = 'block'; // Show video
            video.play(); // Play video
        });

        // Pause video and reset when mouse leaves
        video.addEventListener('mouseout', () => {
            video.pause();
            video.currentTime = 0; // Reset to start
            video.style.display = 'none'; // Hide video
            thumbnail.style.display = 'block'; // Show thumbnail again
        });
    });
});
    </script>
</body>
</html>
