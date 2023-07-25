@extends('layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.update-product', ['id' => $data->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        {{-- <div class="form-group">
                                            <label for="id_transaction">Transaction ID</label>
                                            <input type="text" name="id_transaction" class="form-control"
                                                id="id_transaction" value="{{ $data->id_transaction }}"
                                                placeholder="Type ID Transaction here">
                                            @error('id_transaction')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="product_name" class="form-control" id="product_name"
                                                value="{{ $data->product_name }}" placeholder="Type Product Name here">
                                            @error('product_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="price_item">Price/Item</label>
                                            <input type="text" name="price_item" class="form-control" id="price_item"
                                                value="{{ $data->price_item }}" placeholder="Type Price/Item here">
                                            @error('price_item')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                    </div>
                </form>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
