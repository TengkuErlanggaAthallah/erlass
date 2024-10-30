@extends('layouts.main')
@section('content')
<main class="app-main"> 
    <!--begin::App Content Header-->
    <div class="app-content-header"> 
        <!--begin::Container-->
        <div class="container-fluid"> 
            <!-- Form Start -->
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Tambah User</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                        </ol>
                    </div>
                </div> 
                
                <!--begin::App Content-->
                <div class="app-content"> 
                    <!--begin::Container-->
                    <div class="container-fluid"> 
                        <!--begin::Row-->
                        <div class="row g-4"> 
                            <!--begin::Col-->
                            <div class="col-md-6"> 
                                <!--begin::Quick Example-->
                                <div class="card card-primary card-outline mb-4"> 
                                    <!--begin::Header-->
                                    <div class="card-header">
                                        <div class="card-title">Form Tambah User</div>
                                    </div> 
                                    <!--end::Header--> 
                                    
                                    <!--begin::Form-->
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="role" class="form-label">Pilih Role</label> 
                                            <select name="role" class="form-select" id="role" required>
                                                <option value="" disabled selected>Pilih Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="petugas">Petugas</option>
                                            </select>
                                            @error('role')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3"> 
                                            <label for="email" class="form-label">Email address</label> 
                                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <div id="emailHelp" class="form-text">Enter email</div>
                                        </div>
                                        
                                        <div class="mb-3"> 
                                            <label for="name" class="form-label">Nama</label> 
                                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <div id="nameHelp" class="form-text">Enter Name</div>
                                        </div>

                                        <div class="mb-3"> 
                                            <label for="password" class="form-label">Password</label> 
                                            <input type="password" name="password" class="form-control" id="password" required>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    
                                    <!--begin::Footer-->
                                    <div class="card-footer"> 
                                        <button type="submit" class="btn btn-primary">Submit</button> 
                                    </div>
                                    <!--end::Footer-->
                                </div> 
                                <!--end::Quick Example-->
                            </div> 
                            <!--end::Col--> 
                        </div> 
                        <!--end::Row-->
                    </div> 
                    <!--end::Container-->
                </div> 
                <!--end::App Content-->
            </form>
            <!-- Form End -->
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
        </div> 
        <!--end::Container-->
    </div> 
    <!--end::App Content Header-->
</main>
@endsection
