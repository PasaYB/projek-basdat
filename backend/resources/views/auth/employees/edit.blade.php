@extends('adminlte::page')

@section('title', 'Edit Petugas')

@section('adminlte_css')
    <style>
        .profile-user-img {
            width: 100px !important;
            height: 100px !important;
            object-fit: cover;
            border: 3px solid #adb5bd;
            margin: 0 auto;
            border-radius: 50% !important;
            display: block;
            text-align: center;
            line-height: 94px;
            font-size: 12px;
            color: #6c757d;
            background-color: #f8f9fa;
        }
        
        .box-profile .text-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@stop

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Petugas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Petugas</a></li>
                    <li class="breadcrumb-item active">{{ $employee->name }} / Edit</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-navy card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" id="profilePreview"
                                     src="{{ $employee->profile_image ? asset('storage/' . $employee->profile_image) : asset('vendor/adminlte/dist/img/user4-128x128.jpg') }}"
                                     alt="Profile Picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $employee->name }}</h3>
                            <p class="text-muted text-center">{{ $employee->email }}</p>
                            
                            <div class="mt-3">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*">
                                <small class="form-text text-muted">Leave empty to keep current image</small>
                            </div>
                        </div>
                    </div>

                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Tambahan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="phone_number"><i class="fas fa-phone mr-1"></i> Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" placeholder="Masukkan nomor telepon">
                            </div>

                            <div class="form-group">
                                <label for="address"><i class="fas fa-map-marker-alt mr-1"></i> Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $employee->address) }}" placeholder="Masukkan alamat">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Detail Petugas</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employee->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Leave empty to keep current password">
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Leave empty to keep current password</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                    </div>
                                </div>

                                <hr>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@stop

@section('adminlte_js')
    <script>
        // Preview profile image before upload
        document.getElementById('profile_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@stop
