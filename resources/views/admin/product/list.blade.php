@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 ml-1">
                    <div class="col-sm-6">
                        <h1>Product List</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/product/add') }}" class="btn btn-primary">Add new Product</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_messages')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Product</h3>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">


                                        <div class="form-group col-md-3">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ Request::get('name') }}"
                                                class="form-control" placeholder="Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top: 30px;">Search</button>
                                            <a href="{{ url('admin/product/list') }}" class="btn btn-success"
                                                style="margin-top: 30px;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->


                            </form>
                        </div>

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">All Products</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Category Name</th>
                                            <th>Created By</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category_name }}</td>
                                                <td>{{ $item->created_by_name }}</td>
                                                <td>
                                                    <img src="{{ asset('/images/product/' . $item->image) }}" alt="category"
                                                        width="55px" height="33px"
                                                        style="border-radius: 10px; background-image: cover;">
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/product/show/' . $item->id) }}"
                                                        class="btn btn-primary btn-sm"><i
                                                            class="fas fa-solid fa-eye"></i></a>
                                                    @if ($item->user_id === auth()->user()->id || auth()->user_type == 1)
                                                        <a href="{{ url('admin/product/edit/' . $item->id) }}"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="fas fa-solid fa-pen"></i></a>
                                                        <a href="{{ url('admin/product/delete/' . $item->id) }}"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="m-3 float-right">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
