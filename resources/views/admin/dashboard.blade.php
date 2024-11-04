<!-- Head -->
<head>
    <style>
        /* Warna latar belakang aktif */
        .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

        /* CSS untuk tabel */
        .table td, .table th {
            word-wrap: break-word; /* Memecah kata jika terlalu panjang */
            overflow-wrap: break-word; /* Alternatif untuk word-wrap */
            max-width: 200px; /* Tentukan lebar maksimum untuk kolom */
        }
    </style>
</head>

<!-- Extends layouts.main -->
@extends('layouts.main')

<!-- Section content -->
@section('content')
    <main class="app-main">
        <!-- App Content Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- App Content -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $totalUsers }}</h3>
                                <p>Total Pengguna</p>
                            </div>
                            <svg class="small-box-icon" ... ></svg>
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>

                    <!-- Total Media -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>{{ $totalMedia }}</h3>
                                <p>Total Media yang Diunggah</p>
                            </div>
                            <svg class="small-box-icon" ... ></svg>
                            <a href="{{ route('admin.media.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>

                    <!-- New User Registrations -->
                    <div class="col-lg-6 col-12">
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>{{ $newUserRegistrations }}</h3>
                                <p>Pendaftaran Pengguna Baru Minggu Ini</p>
                            </div>
                            <svg class="small-box-icon" ... ></svg>
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Recent Media -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Media Terbaru</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Tanggal Unggah</th>
                                            <th>Deskripsi</th>
                                            <th>Nama Desainer</th>
                                            <th>Judul Video</th>
                                            <th>Kutipan</th>
                                            <th>Nama Pengguna</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentMedia as $media)
                                        <tr>
                                            <td>{{ $media->category }}</td>
                                            <td>{{ $media->title }}</td>
                                            <td>{{ $media->upload_date }}</td>
                                            <td>{{ Str::limit($media->description, 50) }}</td> <!-- Deskripsi dipersingkat -->
                                            <td>{{ $media->designer_name }}</td>
                                            <td>{{ $media->video_title }}</td>
                                            <td>{{ $media->quote }}</td>
                                            <td>{{ $media->user->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
