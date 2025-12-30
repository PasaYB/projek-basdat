@extends('adminlte::page')

@section('title', 'Daftar Bahan Gudang')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manajemen Stok Bahan Gudang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Bahan Gudang</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Stok {{ $stockRecords->first()->material->ingredient->name }}</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Stok</th>
                                        <th>Detail</th>
                                        <th>Tanggal</th>
                                        {{-- log stock detail --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stockRecords as $stockRecord)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stockRecord->stock }} {{ $stockRecord->material->ingredient->unit->code }}
                                                @if ($stockRecord->type === 'in')
                                                    <span class="text-success">(+{{ $stockRecord->detailRecord->quantity }})</span>
                                                @elseif ($stockRecord->type === 'out')
                                                    <span class="text-danger">(-{{ $stockRecord->detailRecord->quantity }})</span>
                                                @else
                                                    <span class="text-warning">
                                                        @if ($stockRecord->adjustDetailRecord->qty_after - $stockRecord->adjustDetailRecord->qty_before < 0)
                                                            ({{ $stockRecord->adjustDetailRecord->qty_after - $stockRecord->adjustDetailRecord->qty_before }})
                                                        @else
                                                            (+{{ $stockRecord->adjustDetailRecord->qty_after - $stockRecord->adjustDetailRecord->qty_before }})
                                                        @endif
                                                    </span>
                                                @endif                                            
                                            </td>
                                            <td>
                                                @if ($stockRecord->type === 'in')
                                                    <a href="{{ route('material_ins.show', $stockRecord->slug) }}">
                                                        {{ $stockRecord->slug }}
                                                    </a>                                                
                                                @elseif ($stockRecord->type === 'out')
                                                    <a href="{{ route('material_outs.show', $stockRecord->slug) }}">
                                                        {{ $stockRecord->slug }}
                                                    </a>                                                  
                                                @elseif($stockRecord->type === 'adjustment')
                                                    Adjustment: {{ ucfirst($stockRecord->adjustDetailRecord->adjustment_type) }} {{ $stockRecord->slug }} 
                                                @endif  
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($stockRecord->recorded_at)->format('d F Y') }}</td>
                                        </tr>
                                    @endforeach

                                    {{-- TO DO: add qty_before and after in every in or out transaction --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@stop

@section('adminlte_js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    $(function () {
        $('#example2').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>rtip',
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i> Copy',
                    className: 'btn btn-sm btn-dark',
                    exportOptions: { 
                        columns: ':visible:not(:last-child)' 
                    }
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    className: 'btn btn-sm btn-dark',
                    exportOptions: { 
                        columns: ':visible:not(:last-child)' 
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-sm btn-dark',
                    exportOptions: { 
                        columns: ':visible:not(:last-child)' 
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-sm btn-dark',
                    exportOptions: { 
                        columns: ':visible:not(:last-child)' 
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'btn btn-sm btn-dark',
                    exportOptions: { 
                        columns: ':visible:not(:last-child)' 
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-columns"></i> Column visibility',
                    className: 'btn btn-sm btn-dark'
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search data..."
            }
        });

        // SweetAlert2 for delete confirmation
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-2",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>
@stop
