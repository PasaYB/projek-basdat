@extends('adminlte::page')

@section('title', 'Edit Bahan Keluar')

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
                <h1>Edit Bahan Keluar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('material_outs.index') }}">Bahan Keluar</a></li>
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
                <h3 class="card-title">Edit Bahan Keluar</h3>
            </div>
            <form action="{{ route('material_outs.update', $material_out->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="ingredient_id">Bahan</label>
                        <select class="form-control select2" id="ingredient_id" name="ingredient_id" required>
                            <option value=""> Pilih Bahan </option>
                            @foreach($materials as $material)
                                <option value="{{ $material->ingredient_id }}" {{ old('ingredient_id', $material_out->ingredient_id) == $material->ingredient_id ? 'selected' : '' }}>
                                    {{ $material->ingredient->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ingredient_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Jumlah</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah" value="{{ old('quantity', $material_out->quantity) }}" required>
                                <small id="stock_info" class="form-text text-muted"></small>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label for="unit">Satuan</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="unit" name="unit" placeholder="-" value="{{ old('unit', $material_out->unit) }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="out_date">Tanggal Keluar</label>
                                <div class="input-group" id="out_date_picker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                    <input type="text" class="form-control" id="out_date_display" 
                                        data-td-target="#out_date_picker" 
                                        placeholder="" 
                                        value="{{ old('out_date') ? \Carbon\Carbon::parse(old('out_date'))->format('d/m/Y') : \Carbon\Carbon::parse($material_out->out_date)->format('d/m/Y') }}" required readonly>
                                    <input type="hidden" id="out_date" name="out_date" value="{{ old('out_date', $material_out->out_date) }}">
                                    <span class="input-group-text" data-td-target="#out_date_picker" data-td-toggle="datetimepicker">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                                @error('out_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Masukkan catatan">{{ old('note', $material_out->note) }}</textarea>
                        @error('note')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('material_outs.index') }}" class="btn btn-secondary">
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
    
    {{-- Tempus Dominus --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.11/dist/js/tempus-dominus.min.js"></script>

    <script>
        $(document).ready(function() {
            // Store material data
            const materials = @json($materials);
            const currentIngredientId = {{ $material_out->ingredient_id }};

            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: function(){
                    return $(this).data('placeholder');
                }
            });

            // Initialize Tempus Dominus for date picker
            const picker = new tempusDominus.TempusDominus(document.getElementById('out_date_picker'), {
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
                    format: 'dd/MM/yyyy'  // Display format
                }
            });

            // Convert display format to backend format (yyyy-MM-dd)
            picker.subscribe('change.td', (e) => {
                if (e.date) {
                    const year = e.date.year;
                    const month = String(e.date.month + 1).padStart(2, '0');
                    const day = String(e.date.date).padStart(2, '0');
                    $('#out_date').val(`${year}-${month}-${day}`);
                }
            });

            // Update unit and stock info when material is selected
            $('#ingredient_id').on('change', function() {
                const ingredientId = $(this).val();
                if (ingredientId) {
                    const material = materials.find(m => m.ingredient_id == ingredientId);
                    if (material) {
                        $('#unit').val(material.ingredient.unit);
                        
                        // Show available stock (add current out quantity back for editing)
                        const availableStock = material.quantity + (ingredientId == currentIngredientId ? {{ $material_out->quantity }} : 0);
                        $('#stock_info').text('Stok tersedia: ' + availableStock + ' ' + material.ingredient.unit);
                        $('#quantity').attr('max', availableStock);
                        
                        // Set minDate restriction based on latest in_date
                        if (material.latest_in_date) {
                            picker.updateOptions({
                                restrictions: {
                                    minDate: new tempusDominus.DateTime(material.latest_in_date)
                                }
                            });
                        }
                    }
                } else {
                    $('#unit').val('');
                    $('#stock_info').text('');
                    $('#quantity').removeAttr('max');
                    
                    // Remove date restriction
                    picker.updateOptions({
                        restrictions: {
                            minDate: undefined
                        }
                    });
                }
            });

            // Trigger change on page load to set initial values
            $('#ingredient_id').trigger('change');
        });
    </script>
@stop
