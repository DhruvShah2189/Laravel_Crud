@extends('layouts.app')

<style>
    .modal-footer .btn-default.close {
        width: 90px;
        border: 1px solid #000;
        background: #e9ecef;
        padding: 6px;
        margin: 2px;
    }

    :focus-visible {
        outline: ghostwhite;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px 6px !important;
    }
    .dataTables_paginate .pagination li.paginate_button{
        padding: 0;
        margin: 0;
    }
    .pagination li.paginate_button.active,
    .pagination li.paginate_button.active:hover {
        background: transparent;
        box-shadow: none;
        border-color: transparent;
    }
</style>

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="btn-group pull-right" style="float:right;">
                                    <a href="{{ route('products.create') }}"
                                        class="btn btn-primary pull-right create-event">
                                        <span class="text">Add Product</span>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
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
                                <table id="table" class="table table-bordered">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>Id</th>
                                            <th>Product Icon</th>
                                            <th>Product Name</th>
                                            <th>Product Price</th>
                                            <th>Product Category</th>
                                            <th>Product Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div><!-- comment -->
                </div>
            </div><!-- comment -->
        </section>
        <!-- /.content -->
    </div>

    {{-- <div class="modal fade" id="product_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" class="form-control" id="prodname" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Category</label>
                        <input type="text" class="form-control" id="category" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Product Price</label>
                        <input type="text" class="form-control" id="product_price" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Product Image</label>
                        <input type="image" style="width:100px; display:flex;" src="" name="product_image"
                            id="product_image" disabled />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Product Icon</label>
                        <input type="image" style="width:100px; display:flex;" src="" name="product_icon"
                            id="product_icon" disabled />
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default text-black close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                // "paging": true,
                "processing": true,
                "serverSide": true,
                // "info": true,
                "responsive": true,
                "ajax": "{{ route('products.index') }}",
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "product_icon",
                        "render": function(data, type, row) {
                            return '<img src="/product_icons/' + data +
                                '" width="60px" height="60px" style="border-radius:50%;/*margin-top:-26px;*/" />';
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'prodname',
                        name: 'prodname',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'price',
                        name: 'price',
                        orderable: true,
                        // searchable: true
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "product_image",
                        "render": function(data, type, row) {
                            return '<img src="/product_images/' + data +
                                '" width="50px;" height="50px;" />';
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // $('#product_description').summernote('disable');

            // $(document).on("click", "#showUser", function() {
            //     var id = $(this).attr('data-id');
            //     $('.note-editable').attr('class', 'product_description');
            //     $.ajax({
            //         url: "{{ url('products/show') }}" + '/' + id,
            //         method: 'get',
            //         success: function(result) {
            //             $('#product_modal').modal('toggle');
            //             $("#id").val(result.product[0].id);
            //             $("#prodname").val(result.product[0].prodname);
            //             $("#category").val(result.product[0].name);
            //             $("#product_image").val(result.product[0].product_image);
            //             $("#product_icon").val(result.product[0].product_icon);
            //             $("#product_price").val(result.product[0].price);
            //             $("#product_description").val(result.product[0].prod_desc).html();
            //             $("#product_icon").attr('src', '/product_icons/' + result.product[0]
            //                 .product_icon);
            //             $("#product_image").attr('src', '/product_images/' + result.product[0]
            //                 .product_image);
            //         }
            //     });
            // });

            // $('.close').on('click', function() {
            //     $('#product_modal').modal('hide');
            // });

            $(document).on("click", ".delete_product", function() {
                var Id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    console.log(result);
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('products/delete') }}" + '/' + Id,
                            data: {
                                'id': Id,
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                Swal.fire(
                                    'Deleted!',
                                    '',
                                    'success'
                                )
                                $('#table').DataTable().ajax.reload();
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        /*Swal.fire(
                         'Cancelled',
                         '',
                         'error'
                         )*/
                    }
                })
                return false;
            });

            setTimeout(function() {
                $(".alert").remove();
            }, 5000);
        });
    </script>
@endpush
