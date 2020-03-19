@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Lig Oluştur</h1>
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
            <h3 class="card-title">Lig Oluştur</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.league.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="facility">Tesis</label>
                    <select name="facility_id" id="facility" class="form-control">
                        <option value="0">Seçiniz..</option>
                        @foreach($facilities as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Turnuva Adı</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Turnuva Adı">
                </div>
                <div class="form-group">
                    <label for="image">Resim</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image_url">
                            <label class="custom-file-label" for="exampleInputFile">Resim Seç</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_date">Başlangıç Tarihi</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div class="form-group">
                    <label for="cost">Katılım Ücreti</label>
                    <input type="number" class="form-control" id="cost" name="cost" placeholder="Katılım Ücreti">
                </div>
                <div class="form-group">
                    <label for="max_team_count">Maksimum Takım Sayısı</label>
                    <input type="number" class="form-control" id="max_team_count" name="max_team_count" placeholder="Maksimum Takım Sayısı">
                </div>
                <div class="form-group">
                    <label for="max_team_count">Hafta Sayısı</label>
                    <input type="number" class="form-control" id="week_count" name="week_count" placeholder="Kaç Hafta">
                </div>
                <div class="form-group">
                    <label for="min_player_count">Bir Takımdaki Minimum Oyuncu Sayısı</label>
                    <input type="number" class="form-control" id="min_player_count" name="min_player_count" placeholder="Bir Takımdaki Minimum Oyuncu Sayısı">
                </div>
                <div class="form-group">
                    <label for="positions">Ödüller</label>
                    <ul id="positions" class="list-group">

                        @for($i = 1; $i <= 4; $i++)
                            <li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input name="award_key[{{$i}}]" type="checkbox" class="custom-control-input" id="award{{$i}}">
                                    <label class="custom-control-label" for="award{{$i}}">{{$i . '.'}}</label>
                                    <input name="award_title[{{$i}}]" type="text" class="form-control" placeholder="Ödül" />
                                </div>
                            </li>
                        @endfor

                    </ul>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Kaydet</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@section('scripts')

@endsection