@extends('layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Transaksi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Data Transaksi</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.update-transaction', ['id' => $data->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Transaksi</h3>
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

                                        <div class="form-group product_ordered">
                                            <label for="product_ordered"> Product Ordered</label>
                                            <select class="form-control" name="product_ordered" id="product_ordered">
                                                <option data-price="{{ $data->price_item }}" selected>
                                                    {{ $data->product_ordered }}</option>
                                                @foreach ($data_product as $dp)
                                                    <option data-price="{{ $dp->price_item }}">{{ $dp->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('product_ordered')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="price_item">Price/Item</label>
                                            <input type="numeric" name="price_item" class="form-control price_item"
                                                id="price_item" value="{{ $data->price_item }}"
                                                placeholder="This field will automatically filled when selecting Product"
                                                readonly>
                                            @error('price_item')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="text" name="quantity" class="form-control" id="quantity"
                                                value="{{ $data->quantity }}" placeholder="Type Transaction Quantity here"
                                                oninput="totalPrice()">
                                            @error('quantity')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="total_price">Total Price</label>
                                            <input type="numeric" name="total_price" class="form-control" id="total_price"
                                                value="{{ $data->total_price }}"
                                                placeholder="Type Total Price Transaction here" readonly>
                                            @error('total_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="total_paid">Total Paid</label>
                                            <input type="numeric" name="total_paid" class="form-control" id="total_paid"
                                                value="{{ $data->total_paid }}"
                                                placeholder="Type Total Paid Transaction here"
                                                oninput="totalUnpaid_status()">
                                            @error('total_paid')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="total_unpaid">Total Unpaid</label>
                                            <input type="numeric" name="total_unpaid" class="form-control" id="total_unpaid"
                                                value="{{ $data->total_unpaid }}"
                                                placeholder="Type Total Unpaid Transaction here" readonly>
                                            @error('total_unpaid')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="numeric" name="status" class="form-control" id="status"
                                                value="{{ $data->status }}"
                                                placeholder="This field will automatically filled when inputting Total Paid"
                                                readonly>
                                            @error('status')
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $('.product_ordered').on('change', function() {
            $('.price_item')
                .val(
                    $(this).find(':selected').data('price')
                );

            const qty = document.getElementById('quantity').value || 0;
            if (qty) {
                totalPrice();
            }
        });

        function totalPrice() {
            const priceItem = document.getElementById('price_item').value || 0;
            const qty = document.getElementById('quantity').value || 0;
            const totalPrice = parseInt(priceItem) * parseInt(qty);
            document.getElementById('total_price').value = totalPrice;

            totalUnpaid();
            status();
        }

        function totalUnpaid() {
            const totalPrice = document.getElementById('total_price').value || 0;
            const totalPaid = document.getElementById('total_paid').value || 0;
            const totalUnpaid = parseInt(totalPrice) - parseInt(totalPaid);
            if (totalUnpaid < 0) {
                document.getElementById('total_unpaid').value = 0;
            } else {
                document.getElementById('total_unpaid').value = totalUnpaid;
            }
        }

        function status() {
            const totalUnpaid = document.getElementById('total_unpaid').value || 0;

            if (totalUnpaid == 0) {
                document.getElementById('status').value = 'Lunas';
            } else {
                document.getElementById('status').value = 'Belum Lunas';
            }
        }

        function totalUnpaid_status() {
            totalUnpaid();
            status();
        }
    </script>
@endsection
