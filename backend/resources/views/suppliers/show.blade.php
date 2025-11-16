@extends('adminlte::page')

@section('title', 'Detail Supplier')

@section('adminlte_css')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manajemen Supplier</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Supplier</a></li>
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
            <h3 class="card-title">Detail Supplier</h3>
            </div>
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nama Supplier</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $supplier->name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $supplier->phone_number }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label font-weight-bold">Alamat</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $supplier->address }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card card-navy">
            <div class="card-body">
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')

@stop
