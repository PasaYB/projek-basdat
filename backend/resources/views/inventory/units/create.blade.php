@extends('adminlte::page')

@section('title', 'Tambah Satuan')

@section('adminlte_css')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Satuan Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('units.index') }}">Satuan</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
            <h3 class="card-title">Tambah Satuan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('units.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" placeholder="Masukkan Kode">
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('units.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')

@stop
