@extends('layouts.app')

<style>
    label.error {
        color: red;
    }

    .form-group .note-editor.note-frame .note-editing-area {
        overflow: visible;
    }

    .form-group .note-editing-area label {
        position: relative;
        bottom: -42px;
        left: 0;
        margin-bottom: 0;
    }

    .product_category {
        position: relative;
    }

    .product_category label.error {
        position: absolute;
        left: 0px;
        top: 66px;
    }

    span.select2-selection {
        border: 1px solid #ced4da !important;
        background-color: #f8fafc !important;
    }

    .product_form span.select2-selection {
        height: 35px;
    }

    .product_form input.choose-file {
        height:44px;
    }

    .content-wrapper .card-primary {
        margin-bottom: 70px;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
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
                            <form action="{{ route('products.store') }}" method="POST" id="product_form_new"
                                enctype="multipart/form-data" class="product_form">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_name" class="mb-2">Product Name: </label>
                                        <input type="text" class="form-control mb-2" id="product_name"
                                            name="product_name" placeholder="Enter Product Name"
                                            value="{{ old('product_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price" class="mb-2">Product Price: </label>
                                        <input type="number" class="form-control mb-2" id="product_price"
                                            name="product_price" placeholder="Enter Product Price"
                                            value="{{ old('product_price') }}"
                                            onkeydown="javascript: return event.keyCode == 69 ? false : true">
                                    </div>
                                    <div class="form-group mb-4 product_category">
                                        <label for="category_id">Product Category</label>
                                        <select id="category_id" class="form-control" name="category_id[]" multiple>
                                            <option value="">--- Select Category ---</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="product_image" class="mb-2">Product Image:</label>
                                        <input type="file" class="form-control mb-2 choose-file" id="product_image"
                                            name="product_image" value="{{ old('product_image') }}"
                                            placeholder="Upload Product Image"
                                            accept="image/svg+xml, image/png, image/jpeg">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description" class="mb-2">Product Description: </label>
                                        <textarea class="form-control" id="product_description" name="product_description" rows="3"
                                            value="{{ old('product_description') }}" placeholder="Enter Product Description" autocomplete="off"></textarea>
                                    </div>
                                    <div class="form-group" style="margin-top: 30px;">
                                        <label for="product_icon" class="mb-2">Product Icon:</label>
                                        <input type="file" class="form-control mb-2 choose-file" id="product_icon"
                                            name="product_icon" value="{{ old('product_icon') }}"
                                            placeholder="Upload Product Icon"
                                            accept="image/svg+xml, image/vnd.microsoft.icon">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary add_product mt-2 mr-2">Add</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">Back</a>
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
            $('#product_description').summernote({
                height: 200,
            });

            $('#category_id').select2().on('change', function() {
                $(this).validate();
            });

            $('.add_product').click(function() {
                $('.note-editable').attr('name', 'product_description');
            });

            $('.note-editable').attr('name', 'product_description');

            $("#product_form_new").validate({
                onkeyup: function (element) {
                    $(element).valid();
                },
                rules: {
                    product_name: {
                        required: true,
                    },
                    product_price: {
                        required: true,
                        number: true,
                        // minlength: 3,
                        // maxlength: 5,
                    },
                    product_image: {
                        required: true,
                        accept: "image/svg+xml, image/jpeg, image/png",
                    },
                    product_description: "required",
                    product_icon: {
                        required: true,
                        accept: "image/svg+xml, image/vnd.microsoft.icon",
                    },
                    category_id: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: "Product Name is required"
                    },
                    product_price: {
                        required: 'Product Price is required',
                        number: 'Please enter numeric values only',
                        // minlength: 'Product Price has min 3 digits',
                        // maxlength: 'Product Price has max 5 digits',
                    },
                    product_image: {
                        required: "Product Image is required",
                        accept: "Only jpg, jpeg, png and svg extentions are allowed",
                    },
                    product_description: "Product Description is required",
                    product_icon: {
                        required: "Product Icon is required",
                        accept: "Only ico and svg extentions are allowed",
                    },
                    category_id: {
                        required: "Product Category is required",
                    },
                },
            });

            $('select').on('change', function() {
                $(this).valid();
            });

            setTimeout(function() {
                $(".alert").remove();
            }, 5000);
        });
    </script>
@endpush
