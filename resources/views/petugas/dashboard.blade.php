<head>
    <style>
        .nav-link.active {
    background-color: #007bff; /* Warna latar belakang aktif */
    color: #fff; /* Warna teks aktif */
}
    </style>
</head>
@extends('layouts.petugas-main')
@section('content')
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $totalMediaPetugas }}</h3>
                            <p>Total Media Uploaded</p>
                        </div>
                        <svg class="small-box-icon" ... ></svg>
                        <a href="{{ route('petugas.media.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Media</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                @if($recentMedia->isEmpty())
                                    <li>Tidak ada media yang diupload baru.</li>
                                @else
                                    @foreach($recentMedia as $media)
                                        <li>{{ $media->title }} - {{ $media->created_at->format('d M Y') }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main>
@endsection