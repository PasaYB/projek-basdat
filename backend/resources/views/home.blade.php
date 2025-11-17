@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page_css')
    <style>
        #calendar .fc {
            background: transparent !important;
        }

        #calendar .fc-toolbar-title {
            color: #ffffff;
            font-weight: 600;
            font-size: 18px;
        }

        #calendar .fc-button {
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.95);
            border: none;
            box-shadow: none;
            border-radius: 6px;
            padding: .25rem .6rem;
        }

        #calendar .fc-button:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        #calendar .fc-col-header-cell-cushion,
        #calendar .fc-daygrid-day-number {
            color: #ffffff;
            font-weight: 600;
        }

        #calendar .fc-daygrid-day {
            color: rgba(255, 255, 255, 0.9);
        }

        #calendar .fc-daygrid-day.fc-day-today {
            background: rgba(255, 255, 255, 0.06);
            border-radius: 8px;
        }

        #calendar .fc-daygrid-day .fc-daygrid-day-number {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 6px;
        }

        #calendar .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        #calendar .fc-event,
        #calendar .fc-daygrid-event {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 2px 6px;
        }

        #calendar .fc-daygrid-day-frame {
            border: none;
        }

        #calendar .fc-daygrid-day-top {
            padding: .3rem .35rem;
        }

        #calendar {
            width: 100%;
        }
    </style>
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box {{ $categories->count() < 5 ? 'bg-danger' : 'bg-success' }}">
                        <div class="inner">
                            <h3>{{ $categories->count() }}</h3>
                            <p>Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pricetags"></i>
                        </div>
                        <a href="{{ route('categories.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $suppliers->count() }}</h3>
                            <p>Supplier</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cube"></i>
                        </div>
                        <a href="{{ route('suppliers.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $employees->count() }}</h3>
                            <p>Petugas</p>
                        </div>
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-navy">
                            RAWRRR
                            </div>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{ route('employees.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $materials->count() }}</h3>
                            <p>Bahan Gudang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="{{ route('materials.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">
                                Stok Bahan Gudang
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="materialStockChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">
                                Distribusi Kategori
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="categoryChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">
                                Bahan Masuk Terbaru
                            </h3>
                            <div class="card-tools">
                                <a href="{{ route('material_ins.index') }}" class="btn btn-sm btn-navy">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama Bahan</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentMaterialIns as $index => $materialIn)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $materialIn->ingredient->name ?? '-' }}</td>
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ $materialIn->quantity }} {{ $materialIn->ingredient->unit->code ?? '' }}
                                                </span>
                                            </td>
                                            <td>{{ $materialIn->in_date ? \Carbon\Carbon::parse($materialIn->in_date)->format('d M Y') : '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data bahan masuk</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">
                                Bahan Keluar Terbaru
                            </h3>
                            <div class="card-tools">
                                <a href="{{ route('material_outs.index') }}" class="btn btn-sm btn-navy">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama Bahan</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentMaterialOuts as $index => $materialOut)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $materialOut->ingredient->name ?? '-' }}</td>
                                            <td>
                                                <span class="badge badge-danger">
                                                    {{ $materialOut->quantity }} {{ $materialOut->ingredient->unit->code ?? '' }}
                                                </span>
                                            </td>
                                            <td>{{ $materialOut->out_date ? \Carbon\Carbon::parse($materialOut->out_date)->format('d M Y') : '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data bahan masuk</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Material Stock Chart (Bar Chart)
            const materialStockCtx = document.getElementById('materialStockChart').getContext('2d');
            const materials = @json($materials);
            
            const materialLabels = materials.map(m => m.ingredient ? m.ingredient.name : 'Unknown');
            const materialQuantities = materials.map(m => m.quantity);
            
            new Chart(materialStockCtx, {
                type: 'bar',
                data: {
                    labels: materialLabels,
                    datasets: [{
                        label: 'Stok',
                        data: materialQuantities,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        }
                    }
                }
            });

            // Category Chart (Doughnut Chart)
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            const categories = @json($categories);
            
            const categoryLabels = categories.map(c => c.name);
            const categoryCounts = categories.map(c => c.ingredients_count || 0);
            const categoryColors = [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)'
            ];
            
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        label: 'Jumlah Bahan',
                        data: categoryCounts,
                        backgroundColor: categoryColors.slice(0, categoryLabels.length),
                        borderColor: categoryColors.slice(0, categoryLabels.length).map(c => c.replace('0.6', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@stop
