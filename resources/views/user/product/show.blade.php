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
                        <div class="card card-primary">
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name <span style="color: red">*</span></label>
                                        <input type="text" name="name" disabled
                                            value="{{ old('name', $product->name) }}" class="form-control"
                                            placeholder="Name">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="d-flex">
                                        
                                        <div class="form-group col-md-6">
                                          <label>Category Name <span style="color: red">*</span></label>
                                          <select class="form-control" disabled name="category_id">
                                              <option value="">Select Category</option>
                                              @foreach ($category as $item)
                                                  <option {{ $product->category_id == $item->id ? 'selected' : '' }}
                                                      value="{{ $item->id }}">{{ $item->name }}</option>
                                              @endforeach
                                          </select>
                                          <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                      </div>

                                        <div class="form-group col-md-6">
                                            <label>Status <span style="color: red">*</span></label>
                                            <select class="form-control" disabled name="status">
                                                <option value="">Select Status</option>
                                                <option {{ old('status', $product->status) == 0 ? 'selected' : '' }}
                                                    value="0">Inactive</option>
                                                <option {{ old('status', $product->status) == 1 ? 'selected' : '' }}
                                                    value="1">Active</option>
                                            </select>
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                        </div>


                                    </div>

                                    <div class="form-group col-md-6">
                                      <label class="d-block">Picture <span style="color: red"></span></label>
                                      @if (!empty($product))
                                          <img src="{{ asset('images/product/' . $product->image) }}" width="287px",
                                              height="176px" style="border-radius: 10px;">
                                      @endif
                                  </div>
                                    
                                </div>
                                <!-- /.card-body -->
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
