@extends('adminlte::page')

@section('title', 'Detail Kategori')

@section('adminlte_css')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manajemen Kategori</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-navy">
            <div class="card-header">
            <h3 class="card-title">Detail Kategori</h3>
            </div>
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $category->name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Deskripsi</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-navy">
            <div class="card-body">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')

@stop
