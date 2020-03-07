@extends('layouts.admin')

@section('header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tesis Ekle</h1>
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
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tesis Ekle</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{ route('admin.facility.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Tesis Adı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''  }}" id="title" name="title" placeholder="Tesis Adı">
                            </div>
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Telefon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Hesap Numarası</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Hesap Numarası">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-2 col-form-label">İl</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select id="city" name="city" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Seçiniz..</option>
                                        <option>Alaska</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-sm-2 col-form-label">İlçe</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select id="district" name="district" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Seçiniz..</option>
                                        <option>Alaska</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">Ekle</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()
    </script>

@endsection