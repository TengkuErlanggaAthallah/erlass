<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Alat Promosi 2024</title>
    <link rel="shortcut icon" href="/images/erlass.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Candal&display=swap" rel="stylesheet">

    <style>
        /* Bootstrap core CSS */
        @import url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

        /* Font Awesome CSS */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

        /* Custom Styles */
        body {
            font-family: "Poppins", sans-serif;
            background-image: url('/images/background-home.png');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Animasi untuk elemen yang muncul */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
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

        .hero_area {
            padding: 20px;
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }

        .logo-box {
            position: relative;
            height: auto;
            margin-top: 50px;
            animation: slideInDown 0.8s ease-out;
        }

        #left-image {
            position: absolute;
            left: 0; 
            top: 50%; 
            transform: translateY(-50%); 
            max-width: 20vw; /* Ukuran awal lebih kecil untuk gambar kiri */
            width: 140px; /* Ukuran tetap awal untuk gambar kiri */
        }

        #right-image {
            position: absolute;
            right: 0; 
            top: 50%; 
            transform: translateY(-50%); 
            max-width: 30vw; /* Ukuran awal lebih kecil untuk gambar kanan */
            width: 210px; /* Ukuran tetap awal untuk gambar kanan */
        }

        .logo-box img {
            height: auto;
            display: block;
        }

        .hero_area h1 {
            color: #6ba0d1;
            position: relative;
            text-shadow: 
            1px 1px 0 rgb(255, 255, 255),
            -1px -1px 0 rgb(248, 248, 248),
            1px -1px 0 rgb(251, 250, 250),
            -1px 1px 0 rgb(246, 246, 246),
            0 1px 0 rgb(247, 247, 247),
            0 -1px 0 rgb(255, 255, 255);
            font-family: "Candal", sans-serif;
            font-weight: bold;
            font-size: 64px;
            opacity: 1;
            margin-top: 100px; /* Tambahkan jarak antara logo dan judul */
        }

        .hero_area h3 {
            color: #e06324;
            font-family: "Candal", sans-serif;
            font-weight: bold;
            font-size: 25px;
            opacity: 1;
            margin-top: 10px; /* Tambahkan jarak antara judul dan subjudul */
        }

        .hero_area h1,h3 {
            animation: slideInDown 0.8s ease-out;
            text-align: center;
        }

        /* Category Section */
        .category_section {
            padding: 40px 0;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes slideInBounce {
            0% {
                transform: translateX(100%) scale(0.5);
                opacity: 0;
            }
            60% {
                transform: translateX(-10%) scale(1.05);
                opacity: 1;
            }
            100% {
                transform: translateX( 0) scale(1);
                opacity: 1;
            }
        }

        .box {
            display: block;
            text-align: center;
            padding: 20px;
            background-color: rgba(38,169,239,0.4699999988079071);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 10px;
            margin-top: 50px;
            animation: slideInBounce 0.6s ease forwards;
            opacity: 0;
        }

        .box:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .img-box {
            background-color: rgba(38,169,239,0.4699999988079071);
            border-radius: 20px;
            padding: 10px;
            transition: transform 0.3s ease;
        }

        .img-box:hover {
            transform: scale(1.1);
        }

        .img-box img {
            max-width: 80px;
            height: auto;
        }

        .gif-box {
            border-radius: 20px;
            padding: 10px;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gif-box img {
            max-width: 300px;
            height: 300px;
        }

        .detail-box h5 {
            margin-top: 10px;
            color: #333;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .box:hover .detail-box h5 {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero_area h1 {
                font-size: 1.5rem;
            }

            .hero_area h3 {
                font-size: 1.2rem;
            }

            .category_section .box {
                margin-bottom: 20px;
            }

            #left-image {
                max-width: 20vw;
            }

            #right-image {
                max-width: 25vw;
            }
        }

        @media (max-width: 480px) {
            #left-image {
                max-width: 16vw;
            }

            #right-image {
                max-width: 20vw;
            }
        }

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

        .copyright p {
            font-size: 24px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .copyright p {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .copyright p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <div class="logo-box">
            <img id="right-image" src="images/coding.png" alt="Logo kanan" />
            <img id="left-image" src="images/erlass.png" alt="Logo Kiri" />
        </div>
        <h1>Alat Promosi Erlass 2024</h1>
        <h3>Marketing Komunikasi Nasional Erlass Prokreatif Indonesia 2024</h3>

        <!-- Category Section -->
        <section class="category_section">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <!-- Motivational Quotes -->
                    <div class="col-sm-6 col-md-4 col-xl-2 mb-4">
                        <a href="{{ route('motivational.quotes') }}"style="text-decoration: none;">
                            <label class="box rounded">
                                <div class="img-box">
                                    <img src="gif/quotes.gif" alt="Motivational Quotes" />
                                </div>
                                <div class="detail-box">
                                    <h5>Motivational Quotes</h5>
                                </div>
                            </label>
                        </a>
                    </div>

                    <!-- Alat Promosi Internal -->
                    <div class="col-sm-6 col-md-4 col-xl-2 mb-4">
                        <a href="{{ route('alat.promosi') }}"style="text-decoration: none ;">
                            <label class="box rounded">
                                <div class="img-box">
                                    <img src="gif/promosi.gif" alt="Alat Promosi Internal" />
                                </div>
                                <div class="detail-box">
                                    <h5>Alat Promosi Internal</h5>
                                </div>
                            </label>
                        </a>
                    </div>
                    <!-- Produk -->
                    <div class="col-sm-6 col-md-4 col-xl-2 mb-4">
                        <a href="{{ route('produk.index') }}"style="text-decoration: none;">
                            <label class="box rounded">
                                <div class="img-box">
                                    <img src="gif/produk.gif" alt="Produk" />
                                </div>
                                <div class="detail-box">
                                    <h5>Product</h5>
                                </div>
                            </label>
                        </a>
                    </div>

                    <!-- Design Corner -->
                    <div class="col-sm-6 col-md-4 col-xl-2 mb-4">
                        <a href="{{ route('design.corner') }}"style="text-decoration: none;">
                            <label class="box rounded">
                                <div class="img-box">
                                    <img src="gif/idea.gif" alt="Design Corner" />
                                </div>
                                <div class="detail-box">
                                    <h5>Design Corner</h5>
                                </div>
                            </label>
                        </a>
                    </div>

                    <!-- Promotion Video -->
                    <div class="col-sm-6 col-md-4 col-xl-2 mb-4">
                        <a href="{{ route('promotion.videos') }}"style="text-decoration: none;">
                            <label class="box rounded">
                                <div class="img-box">
                                    <img src="gif/film.gif" alt="Promotion Video" />
                                </div>
                                <div class="detail-box">
                                    <h5>Promotion Video</h5>
                                </div>
                            </label>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div style="text-align: center; margin-top: 300px; font-family: Candal, sans-serif; font-weight: regular; opacity: 1; color: white; animation: fadeIn 0.8s ease-in-out;" class="copyright">
        <p> 2024 All Rights Reserved By Erlass Prokreatif Indonesia</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>