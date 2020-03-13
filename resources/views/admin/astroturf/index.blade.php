@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Halı Sahalar</h1>
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
            <h3 class="card-title">Halı Sahalar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Saha</th>
                    <th>Tesis</th>
                    <th>Telefon</th>
                    <th>Şehir</th>
                    <th>İlçe</th>
                </tr>
                </thead>
                <tbody>
                @foreach($astroturfs as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admin.astroturf.show', $item->id) }}">{{ $item->title }}</a></td>
                        <td>{{ $item->facility->title }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->city }}</td>
                        <td>{{ $item->district }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Saha</th>
                    <th>Tesis</th>
                    <th>Telefon</th>
                    <th>Şehir</th>
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