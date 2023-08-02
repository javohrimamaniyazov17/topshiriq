@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row m-1">
                    <!-- left column -->
                    <div class="col-md-12">
                        @include('_messages')
                        <div class="card card-primary">
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name <span style="color: red">*</span></label>
                                        <input type="text" name="name" required value="{{ $category->name }}"
                                            class="form-control" placeholder="Name">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group col-md-6">
                                            <label>Picture <span style="color: red"></span></label>
                                            <input type="file" name="image" class="form-control">
                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                            @if (!empty($category))
                                                <img src="{{ asset('images/category/' . $category->image) }}" width="155px",
                                                    height="100px" style="border-radius: 10px;">
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Status <span style="color: red">*</span></label>
                                            <select class="form-control" required name="status">
                                                <option value="">Select Status</option>
                                                <option {{ old('status', $category->status) == 0 ? 'selected' : '' }}
                                                    value="0">Inactive</option>
                                                <option {{ old('status', $category->status) == 1 ? 'selected' : '' }}
                                                    value="1">Active</option>
                                            </select>
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
