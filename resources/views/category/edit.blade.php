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
                        <h1 class="m-0">Edit Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                            <form action="{{ route('category.update', $category->id) }}" method="POST" id="category_form1" enctype="multipart/form-data" class="category_form">
                                @csrf
                                @method('put')
                                <input type="hidden" class="form-control mb-2" id="id" name="id"
                                    value="{{ $category->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="mb-2">Category Name: </label>
                                        <input type="text" class="form-control mb-2" id="category_name"
                                            value="{{ $category->name }}" name="name" placeholder="Enter Category Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_icon" class="mb-2">Category Icon:</label>
                                        <input type="file" class="form-control mb-2 choose-file" id="category_icon"
                                            name="category_icon" accept="image/svg+xml, image/vnd.microsoft.icon">
                                        <div class="card-body pt-0">
                                            <input type="image" style="width:100px;"
                                                src="/category_icons/{{ $category->category_icon }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mt-2 mr-2">Update</button>
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
            val = $("#id").val();
            console.log(val);
            $("#category_form1").validate({
                onkeyup: function (element) {
                    $(element).valid();
                },
                rules: {
                    // name: "required",
                    name: {
                        required: true,
                        remote: '/validate-category?id=' + val,
                    },
                    category_icon: {
                        accept: "image/svg+xml, image/vnd.microsoft.icon",
                    },
                },
                messages: {
                    name: {
                        required: "Category Name is required",
                        remote: "Category Name should be unique",
                    },
                    // name: "Category Name is required",
                    category_icon: {
                        accept: "Only ico and svg extentions are allowed",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
