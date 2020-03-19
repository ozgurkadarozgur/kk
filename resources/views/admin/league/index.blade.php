@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ligler</h1>
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
            <h3 class="card-title">Eleme Turnuvaları</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tesis</th>
                    <th>Turnuva Adı</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Katılım Ücreti</th>
                    <th>İl/İlçe</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($leagues as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="#">{{ $item->facility->title }}</a></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->start_date }}</td>
                        <td>{{ $item->cost }}</td>
                        <td>{{ $item->facility->city . '/' . $item->facility->district }}</td>
                        <td><a href="{{ route('admin.league.show', $item->id) }}">Görüntüle</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Tesis</th>
                    <th>Turnuva Adı</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Katılım Ücreti</th>
                    <th>İl/İlçe</th>
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