@extends('layouts.facility')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $league->title }}</h1>
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

@section('styles')

    <style>
        .match-item-card:hover{
            background: #fcf8e3;
        }
    </style>

@endsection

@section('content')
    @include('admin.league.modal.edit_match_modal')
    @include('admin.league.modal.over_match_modal')
    <!-- About Me Box -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Fikstür</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @foreach($league->weeks() as $week)
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ $week->week_number }}. Hafta</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($league->fixtureByWeek($week->week_number) as $match)

                                <div class="col-md-6 match-item-card">

                                    <div class="dropdown float-right">
                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            İşlemler
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" style="color: #000;" href="#" onclick="edit_match({{ json_encode($match->foreign_data) }})">Düzenle</a>
                                            <a class="dropdown-item" style="color: #000;" href="#" onclick="over_match({{ json_encode($match->foreign_data) }})">Maçı Bitir</a>
                                        </div>
                                    </div>

                                    <strong><i class="fas fa-book mr-1"></i> Maç Tarihi</strong>

                                    <p class="text-muted">
                                        {{ ($match->start_date) ? $match->start_date : 'Maç tarihi henüz belirlenmedi.' }}
                                    </p>

                                    <strong><i class="fas fa-book mr-1"></i> Maç Saati</strong>

                                    <p class="text-muted">
                                        {{ ($match->start_time) ? $match->start_time : 'Maç saati henüz belirlenmedi.' }}
                                    </p>

                                    <strong><i class="fas fa-book mr-1"></i> Takımlar</strong>

                                    <p class="text-muted">{{ $match->team1->title . ' ' . $match->team1_score . ' - ' . $match->team2_score . ' ' . $match->team2->title }}</p>

                                    <strong><i class="fas fa-book mr-1"></i> Saha</strong>

                                    <p class="text-muted">
                                        {{ ($match->astroturf_id) ? $match->astroturf->title : 'Saha henüz belirlenmedi.' }}
                                    </p>

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

    <script>
        function edit_match(data) {
            let update_url = ("{{ route('facility.league.fixture.update', ':id') }}");
            update_url = update_url.replace(':id', data.id);
            console.log(update_url);
            document.getElementById('modal_edit_match_teams_text').innerText = data.team1 + " - " + data.team2;
            document.getElementById('modal_edit_match_form').action = update_url;
            $('#edit-match-modal').modal('show');
            console.log(data);
        }

        function over_match(data) {
            let update_url = ("{{ route('facility.league.fixture.update', ':id') }}");
            update_url = update_url.replace(':id', data.id);
            document.getElementById('modal_over_match_team1_score').value = null;
            document.getElementById('modal_over_match_team2_score').value = null;
            document.getElementById('modal_over_match_team1_text').innerText = data.team1;
            document.getElementById('modal_over_match_team2_text').innerText = data.team2;
            document.getElementById('modal_over_match_form').action = update_url;
            $('#over-match-modal').modal('show');
            console.log(data);
        }
    </script>

@endsection