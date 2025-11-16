@extends('adminlte::page')

@section('title', 'Edit Bahan')

@section('adminlte_css')
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@endsection

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Bahan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('ingredients.index') }}">Bahan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
            <h3 class="card-title">Edit Bahan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" value="{{ old('name', $ingredient->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Masukkan Unit" value="{{ old('unit', $ingredient->unit) }}" required>
                        @error('unit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price_per_unit">Harga Satuan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" id="price_per_unit_display" placeholder="Masukkan Harga Satuan" value="{{ old('price_per_unit', number_format($ingredient->price_per_unit, 0, ',', '.')) }}" required>
                            <input type="hidden" id="price_per_unit" name="price_per_unit" value="{{ old('price_per_unit', $ingredient->price_per_unit) }}">
                        </div>
                        @error('price_per_unit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select class="form-control select2" id="category_id" name="category_id" required>
                            <option value=""> Pilih Kategori </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $ingredient->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select class="form-control select2" id="supplier_id" name="supplier_id" required>
                            <option value=""> Pilih Supplier </option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $ingredient->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan Deskripsi">{{ old('description', $ingredient->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
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
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    

    <script>
        $(document).ready(function() {
            // Store ingredient data
            const suppliers = @json($suppliers);
            const categories = @json($categories);

            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: function(){
                    return $(this).data('placeholder');
                }
            });

            // Update unit when supplier is selected
            $('#supplier_id').on('change', function() {
                const supplierId = $(this).val();
                if (supplierId) {
                    const supplier = suppliers.find(i => i.id == supplierId);
                    if (supplier) {
                        $('#unit').val(supplier.unit);
                    }
                } else {
                    $('#unit').val('');
                }
            });

            // Update unit when category is selected
            $('#category_id').on('change', function() {
                const categoryId = $(this).val();
                if (categoryId) {
                    const category = categories.find(i => i.id == categoryId);
                    if (category) {
                        $('#unit').val(category.unit);
                    }
                } else {
                    $('#unit').val('');
                }
            });

            // Format price with dots every 3 digits
            $('#price_per_unit_display').on('input', function() {
                let value = $(this).val().replace(/\D/g, ''); // Remove non-digits
                
                if (value) {
                    // Format with dots
                    let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    $(this).val(formatted);
                    
                    // Store unformatted value in hidden field
                    $('#price_per_unit').val(value);
                } else {
                    $('#price_per_unit').val('');
                }
            });
        });
    </script>
@stop
