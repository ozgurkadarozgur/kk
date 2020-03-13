@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $team->title }}</h1>
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
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-book mr-1"></i> Takım Adı</strong>

                    <p class="text-muted">
                        {{ $team->title }}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Oluşturma Tarihi</strong>

                    <p class="text-muted">{{ $team->created_at }}</p>
                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Takım Sahibi</strong>

                    <p class="text-muted">{{ $team->owner->full_name }}</p>

                    <hr>
                </div>
                <div class="col-md-6">
                    <strong><i class="far fa-file-alt mr-1"></i> Oyuncu Sayısı</strong>

                    <p class="text-muted">{{ count($team->members) }}</p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> İl</strong>

                    <p class="text-muted">{{ $team->city->title }}</p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> İlçe</strong>

                    <p class="text-muted">{{ $team->district->title }}</p>

                    <hr>
                </div>
            </div>



        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Oyuncular</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Oyuncu</th>
                    <th>Pozisyon</th>
                    <th>Güç</th>
                </tr>
                </thead>
                <tbody>
                @foreach($team->members as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>{{ $item->position->title }}</td>
                        <td>
                            <div class="progress progress-sm active">
                                <div class="progress-bar bg-danger progress-bar-striped" role="progressbar"
                                     aria-valuenow="{{ $item->power }}" aria-valuemin="0" aria-valuemax="100" style="width: {{$item->power}}%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </td>
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