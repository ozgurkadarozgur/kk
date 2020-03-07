@extends('layouts.admin')

@section('header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><a href="{{ route('admin.facility.show', $astroturf->facility->id) }}">
                            {{ $astroturf->facility->title }}
                        </a>
                        {{ '/' . $astroturf->title }}
                    </h1>
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
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#astroturfs" data-toggle="tab">Sahalar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#create_astroturf" data-toggle="tab">Saha Ekle</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ayarlar</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="astroturfs">
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="create_astroturf">

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" method="post" action="#">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">Saha Adı</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''  }}" id="title" name="title" placeholder="Tesis Adı" value="{{ $astroturf->title }}">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Telefon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon" value="{{ $astroturf->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Adres</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Adres" value="{{ $astroturf->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">Fiyat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Fiyat" value="{{ $astroturf->price }}">
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
                                    <button type="submit" class="btn btn-info float-right">Kaydet</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection
