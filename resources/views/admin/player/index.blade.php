@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Oyuncular</h1>
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
            <h3 class="card-title">Oyuncular</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ad Soyad</th>
                    <th>Lakap</th>
                    <th>Telefon</th>
                    <th>İl</th>
                    <th>İlçe</th>
                    <th>Telefon Kodu</th>
                </tr>
                </thead>
                <tbody>
                @foreach($players as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admin.player.show', $item->id) }}">{{ $item->full_name }}</a></td>
                        <td>{{ $item->nick_name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->city }}</td>
                        <td>{{ $item->district }}</td>
                        <td>{{ $item->phone_code }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ad Soyad</th>
                    <th>Lakap</th>
                    <th>Telefon</th>
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