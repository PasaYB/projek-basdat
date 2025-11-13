@extends('adminlte::page')

@section('title', 'Add Bahan Masuk')

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
                <h1>Manajemen Bahan Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('material_ins.index') }}">Bahan Masuk</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
                <h3 class="card-title">Tambahkan Bahan Masuk Baru</h3>
            </div>
            <form action="{{ route('material_ins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="ingredient_id">Bahan</label>
                        <select class="form-control select2" id="ingredient_id" name="ingredient_id" required>
                            <option value=""> Pilih Bahan </option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}" {{ old('ingredient_id') == $ingredient->id ? 'selected' : '' }}>
                                    {{ $ingredient->name }}
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
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label for="quantity">Satuan</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="unit" name="unit" placeholder="Satuan" value="{{ $ingredient->unit ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="in_date">Tanggal Masuk</label>
                                <div class="input-group" id="in_date_picker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                    <input type="text" class="form-control" id="in_date_display" 
                                        data-td-target="#in_date_picker" 
                                        placeholder="" 
                                        value="{{ old('in_date') ? \Carbon\Carbon::parse(old('in_date'))->format('d/m/Y') : '' }}" required readonly>
                                    <input type="hidden" id="in_date" name="in_date" value="{{ old('in_date') }}">
                                    <span class="input-group-text" data-td-target="#in_date_picker" data-td-toggle="datetimepicker">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                                @error('in_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Masukkan catatan">{{ old('note') }}</textarea>
                        @error('note')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('material_ins.index') }}" class="btn btn-secondary">
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
            // Store ingredient data
            const ingredients = @json($ingredients);

            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: function(){
                    return $(this).data('placeholder');
                }
            });

            // Update unit when ingredient is selected
            $('#ingredient_id').on('change', function() {
                const ingredientId = $(this).val();
                if (ingredientId) {
                    const ingredient = ingredients.find(i => i.id == ingredientId);
                    if (ingredient) {
                        $('#unit').val(ingredient.unit);
                    }
                } else {
                    $('#unit').val('');
                }
            });

            // Initialize Tempus Dominus for date picker
            const picker = new tempusDominus.TempusDominus(document.getElementById('in_date_picker'), {
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
                    $('#in_date').val(`${year}-${month}-${day}`);
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
