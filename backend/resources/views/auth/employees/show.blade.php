@extends('adminlte::page')

@section('title', 'Employee Details')

@section('adminlte_css')
    <style>
        .profile-user-img {
            width: 100px !important;
            height: 100px !important;
            object-fit: cover;
            border: 3px solid #042f59;
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
                <h1>Manajemen Petugas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Petugas</a></li>
                    <li class="breadcrumb-item active">{{ $employee->name }}</li>
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
                                 src="{{ $employee->profile_image ? asset('storage/' . $employee->profile_image) : asset('vendor/adminlte/dist/img/user4-128x128.jpg') }}"
                                 alt="Profile Picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $employee->name }}</h3>
                    </div>
                </div>

                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Phone Number</strong>
                        <p class="text-muted">
                            {{ $employee->phone_number ?? 'Not assigned yet' }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                        <p class="text-muted">{{ $employee->address ?? 'Not assigned yet' }}</p>

                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold">Name</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $employee->name }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold">Created At</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $employee->created_at->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label font-weight-bold">Updated At</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $employee->updated_at->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> 
                                    </a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> 
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
