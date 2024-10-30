@extends('layouts.main')
@section('content')
<main class="app-main"> 
    <!--begin::App Content Header-->
    <div class="app-content-header"> 
        <!--begin::Container-->
        <div class="container-fluid"> 
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User
                        </li>
                    </ol>
                </div>
            </div> 
            <!--end::Row-->
        </div> 
        <!--end::Container-->
    </div> 
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content"> 
        <!--begin::Container-->
        <div class="container-fluid"> 
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

            <!-- Filter Form -->
            <form action="{{ route('admin.user.index') }}" method="GET" class="mb-3">
                <div class="form-group">
                    <label for="role">Filter by Role:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">All</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <!--begin::Row-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.user.edit', ['id' => $d->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.user.destroy', $d->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div> 
        <!--end::Container-->
    </div> 
    <!--end::App Content-->
</main>
@endsection
