@extends('adminlte::page')

@section('title', 'Add Category')

@section('adminlte_css')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
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
            <h3 class="card-title">Insert New Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
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

@stop
