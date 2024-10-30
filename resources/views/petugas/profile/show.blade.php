@extends('layouts.petugas-main')

@section('content')
<div class="container">
    <h2>petugas Profile</h2>

    <!-- Tampilkan notifikasi jika ada -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item">
            <a href="{{ route('petugas.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </li>
    </ul>
</div>
@endsection