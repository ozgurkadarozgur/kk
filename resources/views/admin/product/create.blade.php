@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ürün Yönetimi</h1>
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
            <h3 class="card-title">Ürün Ekle</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Ürün Adı</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''  }}" id="title" name="title" placeholder="Ürün Adı">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Ürün Açıklaması</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}" id="description" name="description" placeholder="Ürün Açıklaması">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Resim</label>
                        <div class="input-group col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : ''  }}" id="image" name="image">
                                <label class="custom-file-label" for="image">Resim Seç</label>
                            </div>
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select id="category_id" name="category_id" class="form-control select2" style="width: 100%;">
                                    <option selected="selected" value="0">Seçiniz..</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Fiyat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : ''  }}" id="price" name="price" placeholder="Fiyat">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('stock') ? 'is-invalid' : ''  }}" id="stock" name="stock" placeholder="Stok">
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('stock') }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Durum</label>
                        <div class="col-sm-10">
                            <input type="checkbox" id="status" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@section('scripts')
    <!-- Bootstrap Switch -->
    <script src="{{ asset('theme/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endsection