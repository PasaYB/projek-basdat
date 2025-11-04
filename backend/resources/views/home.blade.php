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
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-lg-7">
                    <div class="card bg-gradient-navy">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-navy btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-navy btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-navy btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection

@section('page_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            if (calendarEl && typeof FullCalendar !== 'undefined') {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: [
                        {
                            title: 'Meeting',
                            start: '2025-11-15',
                            end: '2025-11-16'
                        },
                        {
                            title: 'Conference',
                            start: '2025-11-20',
                            end: '2025-11-22'
                        }
                    ]
                });
                calendar.render();
            }
        });
    </script>
@stop
