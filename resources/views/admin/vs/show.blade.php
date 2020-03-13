@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $vs->inviter_team->title . ' - ' . $vs->invited_team->title }}</h1>
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
    <!-- About Me Box -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Bilgiler</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Maç Tarihi</strong>

            <p class="text-muted">
                {{ $vs->start_date . ' - ' . $vs->end_date }}
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Halı Saha</strong>

            <p class="text-muted">{{ $vs->astroturf->facility->title . ' / ' . $vs->astroturf->title }}</p>
            <p class="text-muted">{{ $vs->astroturf->city . ' / ' . $vs->astroturf->district }}</p>
            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Ücret</strong>

            <p class="text-muted">{{ $vs->cost }}</p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Durum</strong>

            <p class="text-muted">{{ $vs->status->title }}</p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Hareketler</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($vs->logs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->text }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection

@section('scripts')

@endsection