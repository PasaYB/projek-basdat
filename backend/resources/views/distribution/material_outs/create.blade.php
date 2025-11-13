@extends('adminlte::page')

@section('title', 'Add Pesanan')

@section('adminlte_css')
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    
    {{-- Tempus Dominus --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.11/dist/css/tempus-dominus.min.css" />
@endsection

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manajemen Pesanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pesanan</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
                        <h3 class="card-title">Tambahkan Pesanan Baru</h3>
                    </div>
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control select2" id="supplier_id" name="supplier_id" required>
                                    <option value=""> Pilih Supplier </option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_price">Total Harga</label>
                                        <input type="text" class="form-control" id="total_price_display" 
                                            placeholder="Masukkan Total Harga" 
                                            value="{{ old('total_price') ? number_format(old('total_price'), 0, ',', '.') : '' }}">
                                        <input type="hidden" id="total_price" name="total_price" value="{{ old('total_price') }}">
                                        @error('total_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="order_date">Tanggal Pemesanan</label>
                                        <div class="input-group" id="order_date_picker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                            <input type="text" class="form-control" id="order_date" name="order_date" 
                                                data-td-target="#order_date_picker" 
                                                placeholder="" 
                                                value="{{ old('order_date') }}" required>
                                            <span class="input-group-text" data-td-target="#order_date_picker" data-td-toggle="datetimepicker">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                        </div>
                                        @error('order_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control select2" id="status" name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pesanan</h3>
                    </div>
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control select2" id="supplier_id" name="supplier_id" required>
                                    <option value=""> Pilih Supplier </option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_price">Total Harga</label>
                                        <input type="text" class="form-control" id="total_price_display" 
                                            placeholder="Masukkan Total Harga" 
                                            value="{{ old('total_price') ? number_format(old('total_price'), 0, ',', '.') : '' }}">
                                        <input type="hidden" id="total_price" name="total_price" value="{{ old('total_price') }}">
                                        @error('total_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="order_date">Tanggal Pemesanan</label>
                                        <div class="input-group" id="order_date_picker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                            <input type="text" class="form-control" id="order_date" name="order_date" 
                                                data-td-target="#order_date_picker" 
                                                placeholder="" 
                                                value="{{ old('order_date') }}" required>
                                            <span class="input-group-text" data-td-target="#order_date_picker" data-td-toggle="datetimepicker">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                        </div>
                                        @error('order_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control select2" id="status" name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    {{-- Tempus Dominus --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.11/dist/js/tempus-dominus.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: function(){
                    return $(this).data('placeholder');
                }
            });

            // Initialize Tempus Dominus for date picker
            new tempusDominus.TempusDominus(document.getElementById('order_date_picker'), {
                display: {
                    components: {
                        clock: false,
                        hours: false,
                        minutes: false,
                        seconds: false
                    },
                    icons: {
                        time: 'fas fa-clock',
                        date: 'fas fa-calendar',
                        up: 'fas fa-arrow-up',
                        down: 'fas fa-arrow-down',
                        previous: 'fas fa-chevron-left',
                        next: 'fas fa-chevron-right',
                        today: 'fas fa-calendar-check',
                        clear: 'fas fa-trash',
                        close: 'fas fa-times'
                    }
                },
                localization: {
                    format: 'yyyy-MM-dd'
                }
            });

            // Format price with dots every 3 digits
            $('#total_price_display').on('input', function() {
                let value = $(this).val().replace(/\D/g, ''); // Remove non-digits
                
                if (value) {
                    // Format with dots
                    let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    $(this).val(formatted);
                    
                    // Store unformatted value in hidden field
                    $('#total_price').val(value);
                } else {
                    $('#total_price').val('');
                }
            });
        });
    </script>
@stop
