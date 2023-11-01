@extends('layouts.app')
@section('title', 'purchase-edit')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Purchase </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('purchase.index') }}"> Back</a>
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
    <form action="{{ route('purchase.update', $purchase->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="supplier_id"> Seller </label>
                    <select class="form-control" name="supplier_id" required>
                        <option value="" disabled selected>Select</option>
                        @if ($suppliers)
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $purchase->supplier_id }}"
                                    {{ $purchase->supplier_id === $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->supplier_name }}
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
                                <option {{-- value="{{ $purchase->product_id }}" --}} value="{{ $purchase->product_id }}"
                                    {{ $purchase->product_id === $product->id ? 'selected' : '' }}>
                                    {{ $product->reg_number }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Purchase Quantity:</strong>
                    <input type="number" required id="purchase_quantity" name="purchase_quantity" class="form-control"
                        placeholder="Quantity" required
                        {{-- value="{{ $purchase->purchase_quantity }} --}}
                        ">
                </div>
            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Purchase Rate:</strong>
                    <input type="number" required id="purchase_rate" name="purchase_rate" class="form-control"
                        placeholder="Rate/Price" value="{{ $purchase->purchase_rate }}">
                </div>
            </div>

            {{--   value="{{$purchase->purchase_rate}}"   --}}

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Vat Amount:</strong>
                    <input type="number" id="purchase_vat" name="purchase_vat" class="form-control" placeholder="0"
                        value="{{ $purchase->purchase_vat }}">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Purchase Discount:</strong>
                    <input type="number" id="purchase_discount" name="purchase_discount" class="form-control"
                        placeholder="0" value="{{ $purchase->purchase_discount }}">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Purchase Due:</strong>
                    <input type="number" id="purchase_balance_due" name="purchase_balance_due" class="form-control"
                        placeholder="0" value="{{ $purchase->purchase_balance_due }}">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong> Paid Amount:</strong>
                    <input type="number" id="purchase_amount_paid" name="purchase_amount_paid" class="form-control"
                        placeholder="Paid amount" readonly {{-- value="{{ $purchase->purchase_amount_paid }}" --}}>
                </div>
            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Payment Type: </strong> <span>Like: Cash, Bank </span>
                    <input type="text" name="purchase_payment_type" class="form-control" placeholder="Payment Type"
                        value="{{ $purchase->purchase_payment_type }}">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Purchase Date: </strong>
                    <input type="date" name="purchase_date" class="form-control" placeholder="Purchase Date"
                        value="{{ $purchase->purchase_date }}">
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
            $('#purchase_amount_paid').val(parseInt($('#purchase_quantity').val() * $('#purchase_rate').val()) +
                parseInt($('#purchase_vat').val() - $('#purchase_discount').val() - $('#purchase_balance_due')
                    .val())
            );

        });
    </script>
@endsection
