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
        <div class="row">
            <div class="col-md-6">
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Detail Bahan Masuk</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-leaf mr-2"></i> Nama Bahan</strong>
                        <p class="text-muted mt-2">{{ $material_in->ingredient->name }}</p>
                        <hr>

                        <strong><i class="fas fa-balance-scale mr-2"></i> Jumlah</strong>
                        <p class="text-muted mt-2">{{ $material_in->quantity }} {{ $material_in->ingredient->unit->code }}</p>
                        <hr>

                        <strong><i class="fas fa-calendar mr-2"></i> Tanggal Masuk</strong>
                        <p class="text-muted mt-2">{{ \Carbon\Carbon::parse($material_in->in_date)->format('d F Y') }}</p>
                        <hr>

                        <strong><i class="fas fa-sticky-note mr-2"></i> Catatan</strong>
                        <p class="text-muted mt-2">{{ $material_in->note ?? 'Tidak ada catatan' }}</p>
                    </div>
                </div>

                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Detail Kategori</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-tag mr-2"></i> Jenis</strong>
                        <p class="text-muted mt-2">{{ $material_in->ingredient->category->name }}</p>
                    </div>
                </div>
                
                <div class="card card-navy">
                    <div class="card-body">
                        <a href="{{ route('material_ins.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <a href="{{ route('material_ins.edit', $material_in->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-navy card-outline">
                    <div class="card-body">
                    <strong><i class="fas fa-user mr-2"></i> Pembuat</strong>
                    <p class="text-muted mt-2">{{ $material_in->employees->name }} </p>
                    </div>
                </div>
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Detail Harga</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-money-bill-wave mr-2"></i> Harga Satuan</strong>
                        <p class="text-muted mt-2">Rp {{ number_format($material_in->ingredient->price_per_unit, 0, ',', '.') }}</p>
                        <hr>

                        <strong><i class="fas fa-calculator mr-2"></i> Total Harga</strong>
                        <p class="text-muted mt-2">Rp {{ number_format($material_in->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Detail Supplier</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-box mr-2"></i> Nama Supplier</strong>
                        <p class="text-muted mt-2">{{ $material_in->ingredient->supplier->name }}</p>
                        <hr>

                        <strong><i class="fas fa-phone mr-2"></i> Nomor Telepon</strong>
                        <p class="text-muted mt-2">{{ $material_in->ingredient->supplier->phone_number }}</p>
                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-2"></i> Alamat</strong>
                        <p class="text-muted mt-2">{{ $material_in->ingredient->supplier->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')

@stop
