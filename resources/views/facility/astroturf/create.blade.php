@extends('layouts.facility')

@section('header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $facility->title }}</h1>
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
            <h3 class="card-title">Saha Ekle</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form class="form-horizontal" method="post" action="{{ route('admin.facility.astroturf.store', $facility->id) }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Saha Adı</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''  }}" id="title" name="title" placeholder="Saha Adı">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Telefon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Adres</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Adres">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Fiyat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Fiyat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Çalışma Saatleri</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="time" class="form-control" id="work_hour_start" name="work_hour_start" placeholder="Başlangıç Saati">
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control" id="work_hour_end" name="work_hour_end" placeholder="Bitiş Saati">
                                </div>
                            </div>
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
                    <div class="form-group row">
                        <label for="services" class="col-sm-2 col-form-label">Hizmetler</label>
                        <div class="select2-purple">
                            <select class="form-control select2" id="services" name="services[]" multiple="multiple" data-placeholder="Hizmetleri Seçin..." data-dropdown-css-class="select2-purple" style="width: 100%;">
                                @foreach($services as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Kaydet</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
@endsection

@section('scripts')

    <script>

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

@endsection