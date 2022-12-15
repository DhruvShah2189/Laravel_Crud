@extends('layouts.app')

<style>
    label.error {
        color: red;
    }

    .note-toolbar {
        display: none;
    }

    .note-statusbar {
        display: none;
    }

    .note-editing-area .note-editable {
        background: #e9ecef !important;
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
                        <h1 class="m-0">View Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">View</li>
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
                            <form action="" id="product_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" class="form-control mb-2" id="id" name="id"
                                    value="{{ $products[0]->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_name" class="mb-2">Product Name: </label>
                                        <input type="text" class="form-control mb-2" id="product_name"
                                            value="{{ $products[0]->prodname }}" name="product_name"
                                            placeholder="Enter Product Name" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price" class="mb-2">Product Price: </label>
                                        <input type="number" class="form-control mb-2" id="product_price"
                                            value="{{ $products[0]->price }}" name="product_price"
                                            placeholder="Enter Product Price"
                                            onkeydown="javascript: return event.keyCode == 69 ? false : true" disabled>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="category_id">Product Category</label>
                                        <input type="text" class="form-control" id="category_id"
                                            value="{{ $products[0]->name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_image" class="mb-2">Product Image:</label>
                                        <input type="image" style="width:50px; display:flex;"
                                            src="/product_images/{{ $products[0]->product_image }}" disabled />
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description" class="mb-2">Product Description: </label>
                                        <textarea class="form-control" id="product_description" name="product_description" value="{{ $products[0]->prod_desc }}" rows="3" placeholder="Enter Product Description" autocomplete="off" disabled>{{ $products[0]->prod_desc }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_icon" class="mb-2">Product Icon:</label>
                                        <input type="image" style="width:70px; display:flex;"
                                            src="/product_icons/{{ $products[0]->product_icon }}" disabled />
                                    </div>
                                </div>
                                <div class="card-footer">
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
                disableDragAndDrop:true,
            });
            $('#product_description').summernote('disable');
        });
    </script>
@endpush
