@extends('layouts.app')

<style>
    :focus-visible {
        outline: ghostwhite;
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
                    <h1 class="m-0">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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
                                <a href="{{ route('category.create') }}"
                                    class="btn btn-primary pull-right create-event">
                                    <span class="text">Add Category</span>
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
                                        <th>Category Name</th>
                                        <th>Category Icon</th>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": "{{ route('category.index') }}",
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: "category_icon",
                        "render": function(data, type, row) {
                            return '<img src="/category_icons/' + data +
                                '" width="50px" height="50px" style="border-radius:50%;/*margin-top:-20px;*/" />';
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $(document).on("click", ".delete_category", function() {
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
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('category/delete') }}" + '/' + Id,
                            data: {
                                'id': Id,
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.category) {
                                    Swal.fire({
                                        text: result.category,
                                        icon: 'error',
                                    })
                                } else {
                                    Swal.fire(
                                        'Deleted!',
                                        '',
                                        'success'
                                    )
                                }

                                $('#table').DataTable().ajax.reload();
                            }
                        });
                    } else {

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
