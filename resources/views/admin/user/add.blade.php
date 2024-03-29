@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Yangi Foydalanuvchi Qo'shish</h1>
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
                                        <label>Foydalanuvchi Ismi <span style="color: red">*</span></label>
                                        <input type="text" name="name" required value="{{ old('name') }}"
                                            class="form-control" placeholder="Foydalanuvchi Ismi">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Email <span style="color: red">*</span></label>
                                        <input type="email" name="email" required value="{{ old('email') }}"
                                            class="form-control" placeholder="Elektron Pochta">
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Parol <span style="color: red">*</span></label>
                                        <input type="password" name="password" required class="form-control"
                                            placeholder="Parol">
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Yaratish</button>
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
