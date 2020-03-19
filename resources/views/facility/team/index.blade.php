@extends('layouts.facility')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Takımlar</h1>
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
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Takımlar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Takım Adı</th>
                    <th>Sahibi</th>
                    <th>Oyuncu Sayısı</th>
                    <th>İl</th>
                    <th>İlçe</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admin.team.show', $item->id) }}">{{ $item->title }}</a></td>
                        <td><a href="{{ route('admin.player.show', $item->owner->id) }}">{{ $item->owner->full_name }}</a></td>
                        <td>{{ $item->members->count() }}</td>
                        <td>{{ $item->city->title }}</td>
                        <td>{{ $item->district->title }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Takım Adı</th>
                    <th>Sahibi</th>
                    <th>Oyuncu Sayısı</th>
                    <th>İl</th>
                    <th>İlçe</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@section('scripts')

    <script>
        $(function () {
            $("#example1").DataTable();

        });
    </script>

@endsection