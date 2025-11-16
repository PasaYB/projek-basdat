@extends('adminlte::page')

@section('title', 'Show Bahan Keluar')

@section('adminlte_css')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manajemen Bahan Keluar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('material_outs.index') }}">Bahan Keluar</a></li>
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
            <h3 class="card-title">Detail Bahan Keluar</h3>
            </div>
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama Bahan</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $material_out->ingredient->name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Jumlah</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $material_out->quantity }} {{ $material_out->ingredient->unit }}</p>
                        </div>
                    </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Tanggal Keluar</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($material_out->in_date)->format('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Catatan</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $material_out->note ?? '-'}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <a href="{{ route('material_outs.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')

@stop
