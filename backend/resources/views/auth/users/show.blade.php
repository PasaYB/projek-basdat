@extends('adminlte::page')

@section('title', 'User Details')

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
                <h1>Users Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">{{ $user->name }}</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-navy card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('vendor/adminlte/dist/img/user4-128x128.jpg') }}"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>
                        <p class="text-muted">
                            {{ $user->education ?? 'Not assigned yet' }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted">{{ $user->location ?? 'Not assigned yet' }}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                        <p class="text-muted">
                            @if($user->skills)
                                @foreach(explode(',', $user->skills) as $skill)
                                    <span class="badge badge-navy">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                Not assigned yet
                            @endif
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">{{ $user->notes ?? 'Not assigned yet' }}</p>
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
                                <label class="col-sm-2 col-form-label font-weight-bold">Name</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $user->name }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold">Email</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold">Created At</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $user->created_at->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold">Updated At</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $user->updated_at->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to List
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
