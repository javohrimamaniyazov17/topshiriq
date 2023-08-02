@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 ml-1">
                    <div class="col-sm-6">
                        <h1>Mahsulotlar ro'yxati</h1>
                    </div>
                    <div class="col-sm-1" style="text-align: right">
                        <a href="{{ url('user/product/add') }}" class="btn btn-primary"><i class="nav-icon fas fa-shopping-cart"></i><span> +</span></a>
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
                                <h3 class="card-title">Qidiruv</h3>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">


                                        <div class="form-group col-md-12">
                                            <label>Mahsulot Nomi</label>
                                            <div class="d-flex">
                                                <input type="text" name="name" value="{{ Request::get('name') }}"
                                                class="form-control" placeholder="Mahsulot Nomi">
                                                <a href="{{ url('user/product/list') }}" class="btn" style="margin-left: -38px"><i class="fa fa-times"></i></a>
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
                                <h3 class="card-title">Barcha Mahsulotlar</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="overflow: auto">
                            <table id="productTable" class="table table-tripled">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="min-width: 131px;">Mahsulot Nomi</th>
                                        <th style="min-width: 146px;">Kategoriya Nomi</th>
                                        <th style="min-width: 169px;">Foydalanuvchi Nomi</th>
                                        <th>Rasm</th>
                                        <th>Holat</th>
                                        <th>Harakat</th>
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
                                            <td style="min-width: 145px;">
                                                <a href="{{ url('user/product/show/' . $item->id) }}"
                                                    class="btn btn-primary btn-sm" style="width: 34px;"><i class="fas fa-solid fa-eye"></i></a>
                                                @if ($item->user_id === auth()->user()->id)
                                                    <a href="{{ url('user/product/edit/' . $item->id) }}"
                                                        class="btn btn-warning  btn-sm" style="width: 34px;"><i class="fas fa-solid fa-pen"></i></a>
                                                    <a href="{{ url('user/product/delete/' . $item->id) }}"
                                                        class="btn btn-danger btn-sm" style="width: 34px;"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                animation: 150,
                handle: '.fa-bars',// Set the animation speed in milliseconds (optional)
                onEnd: function (evt) {
                    // This function is triggered when the user stops dragging a row
                    // Use the 'evt' parameter to access the updated row order
                    var updatedOrder = Array.from(tableBody.children).map(function (row) {
                        return row.dataset.id;
                    });

                    // Save the updated row order to localStorage
                    localStorage.setItem('productTable_order', JSON.stringify(updatedOrder));

                    // Output a success message
                    showSuccessMessage("Muvaffaqiyatli amalga oshirildi");
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

            // Function to show a success message
            function showSuccessMessage(message) {
                var messageDiv = document.createElement('div');
                messageDiv.classList.add('alert', 'alert-success');
                messageDiv.innerHTML = message;

                var container = document.querySelector('.content-wrapper');
                container.insertBefore(messageDiv, container.firstChild);

                // Automatically remove the message after 3 seconds
                setTimeout(function () {
                    container.removeChild(messageDiv);
                }, 4000);
            }
        });
    </script>
@endsection
