@extends('layouts.facility')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $elimination->title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

@endsection

@section('content')
    {{ $errors }}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Eşleşmeleri Oluştur</h3>
        </div>
        <!-- /.card-header -->

    </div>
    <!-- /.card -->
@endsection

@section('scripts')

@endsection