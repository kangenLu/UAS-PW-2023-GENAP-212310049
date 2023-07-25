@extends('layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Reporting Data</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Reporting Data</li>
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
                                <h3 class="card-title">Reporting Data Table</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Transaction</th>
                                            <th>Product Ordered</th>
                                            <th>Qty</th>
                                            <th>Price/Item</th>
                                            <th>Total Price</th>
                                            <th>Total Paid</th>
                                            <th>Total Unpaid</th>
                                            <th>Status</th>
                                            <th>Purchase Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>T{{ $d->id }}</td>
                                                <td>{{ $d->product_ordered }}</td>
                                                <td>{{ $d->quantity }}</td>
                                                <td>{{ $d->price_item }}</td>
                                                <td>{{ $d->total_price }}</td>
                                                <td>{{ $d->total_paid }}</td>
                                                <td>{{ $d->total_unpaid }}</td>
                                                <td>{{ $d->status }}</td>
                                                <td>{{ $d->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('user')
    <!-- Sidebar user panel (optional) -->
    <div class="mt-5 mb-3 d-flex align-items-center">
        <div class="image">
            <img src="{{ asset('storage/user-photo/' . $user_logged->photo) }}" class="rounded-circle" width="47"
                height="47">
        </div>
        <div class="info">
            <a href="#" class="d-block mx-2">{{ $user_logged->name }}</a>
        </div>
    </div>
@endsection
