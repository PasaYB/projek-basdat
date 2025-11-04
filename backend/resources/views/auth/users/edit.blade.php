@extends('adminlte::page')

@section('title', 'Edit User')

@section('adminlte_css')
    <style>
        .profile-user-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #adb5bd;
            margin: 0 auto;
        }
    </style>
@stop

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">{{ $user->name }} / Edit</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-navy card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" id="profilePreview"
                                     src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('vendor/adminlte/dist/img/user4-128x128.jpg') }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">{{ $user->email }}</p>
                            
                            <div class="mt-3">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*">
                                <small class="form-text text-muted">Leave empty to keep current image</small>
                            </div>
                        </div>
                    </div>

                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="education"><i class="fas fa-book mr-1"></i> Education</label>
                                <textarea class="form-control" id="education" name="education" rows="3" placeholder="Enter education background">{{ old('education', $user->education) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="location"><i class="fas fa-map-marker-alt mr-1"></i> Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $user->location) }}" placeholder="Enter location">
                            </div>

                            <div class="form-group">
                                <label for="skills"><i class="fas fa-pencil-alt mr-1"></i> Skills</label>
                                <input type="text" class="form-control" id="skills" name="skills" value="{{ old('skills', $user->skills) }}" placeholder="Enter skills (comma separated)">
                                <small class="form-text text-muted">Separate skills with commas (e.g., PHP,Laravel,JavaScript)</small>
                            </div>

                            <div class="form-group">
                                <label for="notes"><i class="far fa-file-alt mr-1"></i> Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter notes">{{ old('notes', $user->notes) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-navy">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-navy">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
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

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Created At</label>
                                    <div class="col-sm-10">
                                        <p class="form-control-plaintext">{{ $user->created_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Updated At</label>
                                    <div class="col-sm-10">
                                        <p class="form-control-plaintext">{{ $user->updated_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save"></i> Save Changes
                                        </button>
                                    </div>
                                </div>
                            </div>
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
