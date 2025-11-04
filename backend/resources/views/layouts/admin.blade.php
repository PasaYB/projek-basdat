@extends('adminlte::page')

{{-- Prepend FullCalendar CSS so it's available for pages that need it --}}
@section('adminlte_css_pre')
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
@stop

{{-- Add custom CSS globally --}}
@section('adminlte_css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom-adminlte.css') }}?v={{ time() }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    @yield('page_css')
@stop

{{-- Add FullCalendar JS and custom JS globally --}}
@section('adminlte_js')
    <!-- FullCalendar JS (needed before page scripts that instantiate the calendar) -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    @yield('page_js')
@stop

