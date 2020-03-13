@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $player->full_name }}</h1>
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
                    <strong><i class="fas fa-book mr-1"></i> Ad Soyad</strong>

                    <p class="text-muted">{{ $player->full_name }}</p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Lakap</strong>

                    <p class="text-muted">{{ $player->nick_name }}</p>
                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Telefon</strong>

                    <p class="text-muted">{{ $player->phone }}</p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Email</strong>

                    <p class="text-muted">{{ $player->email }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-book mr-1"></i> Transfer Durumu</strong>

                    <p class="text-muted">{{ $player->transfer_status }}</p>

                    <hr>

                    <strong><i class="fas fa-book mr-1"></i> Yetenekler</strong>

                    <p class="text-muted">
                        @foreach($player->skill_list as $item)
                            <span class="tag tag-danger">{{ $item->title . ', ' }} </span>
                        @endforeach
                    </p>

                    <hr>

                    <strong><i class="fas fa-book mr-1"></i> Kayıt Tarihi</strong>

                    <p class="text-muted">{{ $player->created_at }}</p>

                    <hr>

                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection

@section('scripts')

@endsection