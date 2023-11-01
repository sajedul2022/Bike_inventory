@extends('layouts.app')
@section('title', 'Edit Sales')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Sales </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('sales.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.update', $sale->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="supplier_id"> Customer </label>
                    <select class="form-control" name="customer_id" required>
                        <option value="" disabled selected>Select</option>
                        @if ($customers)
                            @foreach ($customers as $customer)
                                <option value="{{ $sale->customer_id }}"
                                    {{ $sale->customer_id === $customer->id ? 'selected' : '' }}>
                                    {{ $customer->customer_name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="product_id"> Bike Reg. Number </label>
                    <select class="form-control" name="product_id" required>
                        <option value="" disabled selected>Select</option>
                        @if ($products)
                            @foreach ($products as $product)
                                <option value="{{ $sale->product_id }}"
                                    {{ $sale->product_id === $product->id ? 'selected' : '' }}>
                                    {{ $product->reg_number }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Sales Quantity:</strong>
                    <input type="number" required id="sales_quantity" name="sales_quantity" class="form-control"
                        placeholder="Quantity" required {{-- value="{{ $sale->sales_quantity }} --}} ">
                    </div>
                </div>


                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Sales Rate:</strong>
                        <input type="number" required id="sale_price" name="sale_price" class="form-control"
                            placeholder="Rate/Price" value="{{ $sale->sale_price }}">
                    </div>
                </div>

                {{--   value="{{$sales->sales_rate}}"   --}}

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Vat Amount:</strong>
                        <input type="number" id="sales_vat" name="sales_vat" class="form-control" placeholder="0"
                            value="{{ $sale->sales_vat }}">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>sales Discount:</strong>
                        <input type="number" id="sales_discount" name="sales_discount" class="form-control"
                            placeholder="0" value="{{ $sale->sales_discount }}">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>sales Due:</strong>
                        <input type="number" id="sales_balance_due" name="sales_balance_due" class="form-control"
                            placeholder="0" value="{{ $sale->sales_balance_due }}">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong> Paid Amount:</strong>
                        <input type="number" id="sales_amount_paid" name="sales_amount_paid" class="form-control"
                            placeholder="Paid amount" readonly {{-- value="{{ $sale->sales_amount_paid }}" --}}>
                    </div>
                </div>


                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Payment Type: </strong> <span>Like: Cash, Bank </span>
                        <input type="text" name="sales_payment_type" class="form-control" placeholder="Payment Type"
                            value="{{ $sale->sales_payment_type }}">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>sales Date: </strong>
                        <input type="date" name="sales_date" class="form-control" placeholder="sales Date"
                            value="{{ $sale->sales_date }}">
                        </br>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control"> Update </button>
                    </div>
                </div>
            </div>
        </form>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $('form input').on('keyup', function() {
                $('#sales_amount_paid').val(parseInt($('#sales_quantity').val() * $('#sale_price').val()) +
                    parseInt($('#sales_vat').val() - $('#sales_discount').val() - $('#sales_balance_due')
                        .val())
                );

            });
        </script>

@endsection
