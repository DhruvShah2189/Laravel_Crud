@extends('layouts.app')

<style>
    label.error {
        color: red;
    }
    .category_form input.choose-file {
        height:44px;
    }
</style>

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('category.store') }}" method="POST" id="category_form"
                                enctype="multipart/form-data" class="category_form">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="mb-2">Category Name: </label>
                                        <input type="text" class="form-control mb-2" id="category_name" name="name"
                                            placeholder="Enter Category Name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_icon" class="mb-2">Category Icon:</label>
                                        <input type="file" class="form-control mb-2 choose-file" id="category_icon"
                                            name="category_icon" placeholder="Upload Category Icon"
                                            value="{{ old('category_icon') }}"
                                            accept="image/svg+xml, image/vnd.microsoft.icon">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mt-2 mr-2">Add</button>
                                    <a href="{{ route('category.index') }}" class="btn btn-primary mt-2">Back</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div><!-- comment -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // val = $("#category_name").val();
            $("#category_form").validate({
                onkeyup: function (element) {
                    $(element).valid();
                },
                rules: {
                    // debug: true,
                    name: {
                        required: true,
                        remote: '/validate-category',
                    },
                    category_icon: {
                        required: true,
                        accept: "image/svg+xml, image/vnd.microsoft.icon",
                    },
                },
                messages: {
                    name: {
                        required: "Category Name is required",
                        remote: "Category Name should be unique",
                    },
                    category_icon: {
                        required: "Category Icon is required",
                        accept: "Only ico and svg extentions are allowed",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            setTimeout(function() {
                $(".alert").remove();
            }, 5000);
        });
    </script>
@endpush
