@extends('adminlte::page')

{{-- Add custom CSS globally --}}
@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/custom-adminlte.css') }}">
    @yield('page_css')
@stop

{{-- Add custom JS globally --}}
@section('adminlte_js')
    @yield('page_js')
@stop
