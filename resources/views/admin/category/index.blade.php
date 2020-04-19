@extends('layouts.admin')

@section('header')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kategori Yönetimi</h1>
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
            <h3 class="card-title">Kategoriler</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped products">
                <thead>
                <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 20%">Kategori Adı</th>
                    <th style="width: 30%">Ürün Sayısı</th>
                    <th>Alt Kategori Sayısı</th>
                    <th style="width: 8%" class="text-center">Durum</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('admin.category.show', $item->id) }}">{{ $item->title }}</a></td>
                            <td>{{ $item->products->count() }}</td>
                            <td>
                                @if( $item->subcategories->count() > 0)
                                    <a class="btn btn-primary" data-toggle="collapse" href="#product_collapse_{{ $item->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        {{ $item->subcategories->count() }}
                                    </a>
                                    @else
                                    {{ $item->subcategories->count() }}
                                @endif

                            </td>
                            <td class="project-state">{{ ($item->is_active) ? 'Aktif' : 'Pasif'  }}</td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="collapse" id="product_collapse_{{ $item->id }}">
                                    <h5>{{ $item->title }} / Alt Kategoriler</h5>
                                    <div class="card card-body">
                                        <table class="table table-striped products">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kategori Adı</th>
                                                    <th>Durum</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($item->subcategories as $subcategory)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.category.show', $subcategory->id) }}">
                                                            {{ $subcategory->title }}
                                                        </a>
                                                    </td>
                                                    <td class="project-state">{{ ($item->is_active) ? 'Aktif' : 'Pasif'  }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection