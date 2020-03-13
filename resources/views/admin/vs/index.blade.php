@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">VS İstekleri</h1>
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
            <h3 class="card-title">VS İstekleri</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Davet Eden Takım</th>
                    <th>Davet Edilen Takım</th>
                    <th>Durum</th>
                    <th>İşlem Tarihi</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($vs_list as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admin.team.show', $item->inviter_team->id) }}">{{ $item->inviter_team->title }}</a></td>
                        <td><a href="{{ route('admin.team.show', $item->invited_team->id) }}">{{ $item->invited_team->title }}</a></td>
                        <td>{{ $item->status->title }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.vs.show', $item->id) }}">Görüntüle</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Davet Eden Takım</th>
                    <th>Davet Edilen Takım</th>
                    <th>Durum</th>
                    <th>İşlem Tarihi</th>
                    <th></th>
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