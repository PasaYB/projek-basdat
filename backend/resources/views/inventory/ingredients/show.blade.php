@extends('adminlte::page')

@section('title', 'Detail Bahan')

@section('adminlte_css')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manajemen Bahan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Bahan</a></li>
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
            <h3 class="card-title">Detail Bahan</h3>
            </div>
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $ingredient->name }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Harga Satuan</label>
                        <div class="col-sm-10">
                        <p class="form-control-plaintext">Rp {{ number_format($ingredient->price_per_unit, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Jenis</label>
                        <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ $ingredient->category->name }}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label font-weight-bold">Satuan</label>
                        <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ $ingredient->unit }}</p>
                        </div>
                    </div>

                    <hr>

                </div>
            </div>
        </div>
        <div class="card card-navy">
            <div class="card-body">
                <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')

@stop
