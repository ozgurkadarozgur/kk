@extends('layouts.admin')

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
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('kk_logo.png') }}"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $facility->title }}</h3>

                    <p class="text-muted text-center">{{ $facility->owner }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Saha Sayısı</b> <a class="float-right">{{ $facility->astroturfs->count() }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Telefon</b> <a class="float-right">{{ $facility->phone }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Şehir</b> <a class="float-right">{{ $facility->city }}</a>
                        </li>
                    </ul>
                    <div class="text-center">
                        <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-on-text="AÇIK" data-off-text="KAPALI" data-off-color="danger" data-on-color="success">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Hakkında</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Banka Hesap Bilgileri</strong>

                    <p class="text-muted">
                        {{ $facility->bank_account }}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasyon</strong>

                    <p class="text-muted">{{ $facility->district . ', ' . $facility->city }}</p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Email</strong>

                    <p class="text-muted">{{ $facility->email }}</p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Yetkili</strong>

                    <p class="text-muted">{{ $facility->owner }}</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
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

                            @foreach($facility->astroturfs as $item)
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{ asset('kk_logo.png') }}" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="{{ route('admin.astroturf.show', $item->id) }}">{{ $item->title }}</a></h5>
                                                <p class="card-text">{{ $item->price }}</p>
                                                <p class="card-text"><small class="text-muted">Eklenme tarihi: 12-02-2020</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="create_astroturf">
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
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" method="post" action="{{ route('admin.facility.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">Tesis Adı</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''  }}" id="title" name="title" placeholder="Tesis Adı" value="{{ $facility->title }}">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="owner" class="col-sm-2 col-form-label">Yetkili</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control {{ $errors->has('owner') ? 'is-invalid' : ''  }}" id="owner" name="owner" placeholder="Yetkili" value="{{ $facility->owner }}">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('owner') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $facility->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Telefon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon" value="{{ $facility->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Hesap Numarası</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Hesap Numarası" value="{{ $facility->bank_account }}">
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
    <!-- /.row -->
@endsection

@section('scripts')

    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

@endsection