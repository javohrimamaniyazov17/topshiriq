@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div id="successMessage" class="alert alert-success" style="display: none;">
            Muvaffaqiyatli amalga oshirildi
        </div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 ml-1">
                    <div class="col-sm-6">
                        <h1>Foydalanuvchilar Ro'yxati</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/users/add') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Qidiruv</h3>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Foydalanuvchi Ismi</label>
                                            <div class="d-flex">
                                            <input type="text" name="name" value="{{ Request::get('name') }}"
                                                class="form-control" placeholder="Foydalanuvchi Ismi">
                                            <a href="{{ url('admin/users/list') }}" class="btn" style="margin-left: -38px"><i class="fa fa-times"></i></a>
                                            <button class="ml-1 btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">Barcha Foydalanuvchilar</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="overflow: auto">
                                <table id="userTable" class="table table-tripled">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ism</th>
                                            <th>Elektron Pochta</th>
                                            <th>Harakat</th>
                                        </tr>
                                    </thead>
                                    <tbody style="cursor: pointer;">
                                        @foreach ($users as $item)
                                            <tr data-id="{{ $item->id }}">
                                                <td><i class="fas fa-solid fa-bars"></i></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td style="min-width: 118px;">
                                                    <a href="{{ url('admin/users/edit/' . $item->id) }}"
                                                        class="btn btn-warning btn-sm" style="width: 35px;"><i
                                                            class="fas fa-solid fa-pen"></i></a>
                                                    <a href="{{ url('admin/users/delete/' . $item->id) }}"
                                                        class="btn btn-danger btn-sm" style="width: 35px;"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
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

    <!-- Add the success message element -->
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tableBody = document.getElementById('userTable').querySelector('tbody');
            var sortableTable;

            // Function to initialize Sortable.js and set the initial order
            function initializeSortable() {
                sortableTable = new Sortable(tableBody, {
                    animation: 150, // Set the animation speed in milliseconds (optional)
                    handle: '.fa-bars', // Use the handle for drag and drop functionality
                    onEnd: function (evt) {
                        // This function is triggered when the user stops dragging a row
                        // Use the 'evt' parameter to access the updated row order
                        var updatedOrder = Array.from(tableBody.children).map(function (row) {
                            return row.dataset.id;
                        });

                        // Save the updated row order to localStorage
                        localStorage.setItem('userTable_order', JSON.stringify(updatedOrder));

                        // Show the success message
                        var successMessage = document.getElementById('successMessage');
                        successMessage.style.display = 'block';

                        // Hide the success message after 3 seconds
                        setTimeout(function () {
                            successMessage.style.display = 'none';
                        }, 4000);
                    }
                });
            }

            // Get the current row order from localStorage (if available)
            var savedOrder = localStorage.getItem('userTable_order');
            if (savedOrder) {
                savedOrder = JSON.parse(savedOrder);
            }

            // Update the table with the new row order
            updateTableOrder(savedOrder);

            // Initialize Sortable.js and set the initial order
            initializeSortable();

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
