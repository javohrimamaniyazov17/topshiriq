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
                            <table id="productTable" class="table table-striped">
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
                                <tbody style="cursor: pointer;">
                                    @foreach ($products as $item)
                                        <tr data-id="{{ $item->id }}" style="cursor: pointer;">
                                            <td><i class="fas fa-solid fa-bars"></i></td>
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
                                                    class="btn btn-primary btn-sm"><i class="fas fa-solid fa-eye"></i></a>
                                                <a href="{{ url('admin/product/edit/' . $item->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-solid fa-pen"></i></a>
                                                <a href="{{ url('admin/product/delete/' . $item->id) }}"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tableBody = document.getElementById('productTable').querySelector('tbody');
    
            // Get the current row order from localStorage (if available)
            var savedOrder = localStorage.getItem('productTable_order');
            if (savedOrder) {
                savedOrder = JSON.parse(savedOrder);
            }
    
            // Update the table with the new row order
            updateTableOrder(savedOrder);
    
            // Initialize Sortable.js on the table to make the rows sortable
            var sortableTable = new Sortable(tableBody, {
                animation: 150, // Set the animation speed in milliseconds (optional)
                onEnd: function (evt) {
                    // This function is triggered when the user stops dragging a row
                    // Use the 'evt' parameter to access the updated row order
                    var updatedOrder = Array.from(tableBody.children).map(function (row) {
                        return row.dataset.id;
                    });
    
                    // Save the updated row order to localStorage
                    localStorage.setItem('productTable_order', JSON.stringify(updatedOrder));
                }
            });
    
            // Function to update the table rows order
            function updateTableOrder(order) {
                if (!order) {
                    // If no order is available, use the default order
                    order = Array.from(tableBody.children).map(function (row) {
                        return row.dataset.id;
                    });
                }
    
                var rows = Array.from(tableBody.children);
                var newRowOrder = [];
    
                order.forEach(function (id) {
                    var row = rows.find(function (row) {
                        return row.dataset.id === id;
                    });
                    if (row) {
                        newRowOrder.push(row);
                    }
                });
    
                // Remove all existing rows from the table body
                while (tableBody.firstChild) {
                    tableBody.removeChild(tableBody.firstChild);
                }
    
                // Append the rows back to the table body in the new order
                newRowOrder.forEach(function (row) {
                    tableBody.appendChild(row);
                });
            }
        });
    </script>
@endsection
