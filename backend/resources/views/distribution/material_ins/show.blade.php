@extends('adminlte::page')

@section('title', 'Show Bahan Masuk')

@section('adminlte_css')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manajemen Bahan Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('material_ins.index') }}">Bahan Masuk</a></li>
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
            <h3 class="card-title">Detail Bahan Masuk</h3>
            </div>
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama Supplier</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $material_in->ingredient->supplier->name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama Bahan</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $material_in->ingredient->name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Jumlah</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $material_in->quantity }} {{ $material_in->unit }}</p>
                        </div>
                    </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Harga Satuan</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ number_format($material_in->ingredient->price_per_unit, 2, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Total Harga</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ number_format($material_in->total_price, 2, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Tanggal Masuk</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($material_in->in_date)->format('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Catatan</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $material_in->note ?? 'HIDUP JOKOWIIIIIIIIIIIIIIII'}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <a href="{{ route('material_ins.index') }}" class="btn btn-secondary">
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
