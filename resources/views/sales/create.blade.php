@extends('layouts.app')
@section('title', 'Create')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New </h2>
            </div>
            <div class="">
                <a class="btn btn-primary" href="{{ route('sales.index') }}"> Back </a>
            </div>
            </br>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="row">

        {{-- Create Customer --}}
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3> Create Customer </h3>
                </div>

                <div class="card-body">

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

                    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            {{-- 'customer_name', 'father_name', 'email', 'phone', 'nid', 'nid_image', 'address' --}}

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Customer Name:</strong>
                                    <input type="text" name="customer_name" class="form-control"
                                        placeholder="Customer Name">

                                    @if ($errors->has('customer_name'))
                                        <div class="error text-red-500 text-xs">{{ $errors->first('customer_name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Father Name:</strong>
                                    <input type="text" name="father_name" class="form-control" placeholder="Father Name">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Email: </strong>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Phone Number:</strong>
                                    <input type="number" name="phone" class="form-control" placeholder="Phone Name">

                                    @if ($errors->has('phone'))
                                        <div class="error text-red-500 text-xs">{{ $errors->first('phone') }}</div>
                                    @endif

                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>NID Number: </strong>
                                    <input type="text" name="nid" class="form-control" placeholder="Nid  Number">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Date Of Birth: </strong>
                                    <input type="date" name="dob" class="form-control" placeholder="Date of Birth">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>NID Image:</strong> <span>jpg, png, jpeg</span>
                                    <input type="file" name="nid_image" class="form-control" placeholder="image">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong> Address:</strong>
                                    <textarea class="form-control" style="height:150px" name="address" placeholder="Detail"></textarea>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Mediator Name:</strong>
                                    <input type="text" name="mediator_name" class="form-control"
                                        placeholder="Mediator Name">
                                    </br>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Mediator Phone:</strong>
                                    <input type="number" name="mediator_phone" class="form-control"
                                        placeholder="Mediator Phone "> </br>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control"> Add </button>
                                </div>
                            </div>

                        </div>

                </div>
                </form>

            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3> New Sale </h3>
                </div>
                <div class="card-body">

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

                    <form action="{{ route('sales.store') }}" method="POST" {{-- enctype="multipart/form-data" --}}>
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="supplier_id"> Customer </label>
                                    <select class="form-control" name="customer_id" required>
                                        <option value="" disabled selected>Select</option>
                                        @if ($customers)
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"> {{ $customer->customer_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="product_id"> Products </label>
                                    <select class="form-control" name="product_id" required>
                                        <option value="" disabled selected>Select</option>
                                        @if ($products)
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Sale Quantity:</strong>
                                    <input type="number" required id="sales_quantity" name="sales_quantity"
                                        class="form-control" placeholder="Quantity">
                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Sales Rate:</strong>
                                    <input type="number" required id="sale_price" name="sale_price"
                                        class="form-control" placeholder="Rate/Price">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Vat Amount:</strong>
                                    <input type="number" id="sales_vat" name="sales_vat" class="form-control"
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong> Discount:</strong>
                                    <input type="number" id="sales_discount" name="sales_discount" class="form-control"
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Sales Due:</strong>
                                    <input type="number" id="sales_balance_due" name="sales_balance_due"
                                        class="form-control" placeholder="0">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong> Paid Amount:</strong>
                                    <input type="number" id="sales_amount_paid" name="sales_amount_paid"
                                        class="form-control" placeholder="Paid amount" readonly>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Payment Type: </strong> <span>Like: Cash, Bank </span>
                                    <input type="text" name="sales_payment_type" class="form-control"
                                        placeholder="Payment Type">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Sales Date: </strong>
                                    <input type="date" name="sales_date" class="form-control"
                                        placeholder="Sales Date">
                                    </br>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control"> Add </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
                $('form input').on('keyup', function() {
                    $('#sales_amount_paid').val(parseInt($('#sales_quantity').val() * $('#sale_price').val()) +
                        parseInt($('#sales_vat').val() - $('#sales_discount').val() - $('#sales_balance_due')
                            .val())
                    );

                });
            </script>

        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


@endsection
