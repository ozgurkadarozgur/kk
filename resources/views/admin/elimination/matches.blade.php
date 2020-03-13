@extends('layouts.admin')

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
    <!-- About Me Box -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Eşleşmeler</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @foreach($elimination->levels as $level)
                @if(count($level->matches) == 0)
                    @continue
                @endif
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ $level->title }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($level->matches as $match)

                                <div class="col-md-6">
                                    <strong><i class="fas fa-book mr-1"></i> Maç Tarihi</strong>

                                    <p class="text-muted">
                                        {{ ($match->start_date) ? $match->start_date : 'Maç tarihi henüz belirlenmedi.' }}
                                    </p>

                                    <strong><i class="fas fa-book mr-1"></i> Takımlar</strong>

                                    <p class="text-muted">{{ $match->team1->title . ' - ' . $match->team2->title }}</p>

                                    <hr>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


@endsection

@section('scripts')

@endsection