@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Start Container -->
        <div class="container-fluid">
            <div class="row d-flex ml-0 mr-0">
                <div class="col-md-2 mb-2 mt-4 text-center">
                    <div class="card bg-primary">
                        <a href="{{ route('category.index') }}" style="text-decoration: none;">
                            <div class="row">
                                {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">
                            <i class="fas fa-bold fa-4x mb-2"></i>
                        </div> --}}
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                                    <h4>Categories</h4>
                                    <h2>{{ $categories }}</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 mb-2 mt-4 text-center">
                    <div class="card bg-danger">
                        <a href="{{ route('products.index') }}" style="text-decoration: none;">
                            <div class="row">
                                {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">
                            <i class="fas fa-fire fa-4x mb-2"></i>
                        </div> --}}
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                                    <h4>Products</h4>
                                    <h2>{{ $products }}</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
