@extends('layouts.app')
@section('title', 'Create')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New </h2>
            </div>
            <div class="">
                <a class="btn btn-primary" href="{{ route('purchase.index') }}"> Back </a>
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

        <div class="col-md-7">
            <form action="{{ route('purchase.store') }}" method="POST"
            {{-- enctype="multipart/form-data" --}}
            >
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="supplier_id"> Suppliers </label>
                            <select class="form-control" name="supplier_id" required>
                                <option value="" disabled selected>Select</option>
                                @if ($suppliers)
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"> {{ $supplier->supplier_name }} </option>
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
                            <strong>Purchase Quantity:</strong>
                            <input type="number" name="purchase_quantity" class="form-control" placeholder="Quantity">
                        </div>
                    </div>


                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Purchase Rate:</strong>
                            <input type="number" name="purchase_rate" class="form-control" placeholder="Rate/Price">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Sale Price:</strong>
                            <input type="number" name="sale_price" class="form-control" placeholder="sale price ">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Payment Type: </strong> <span>Like: Cash, Bank, Bkash etc. </span>
                            <input type="text" name="purchase_payment_type" class="form-control"
                                placeholder="Payment Type">
                        </div>
                    </div>



                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Purchase Date: </strong>
                        <input type="date" name="purchase_date" class="form-control" placeholder="Registration Date"> </br>
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

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3> Create Supplier </h3>
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
                <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Supplier Name:</strong>
                                <input type="text" name="supplier_name" class="form-control" placeholder="Supplier Name">
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
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>NID Number: </strong>
                                <input type="text" name="nid" class="form-control" placeholder="NID  Number">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>NID Image:</strong>
                                <p>jpeg,png,jpg,giv,svg|max:2048</p>
                                <input type="file" name="nid_image" class="form-control" placeholder="image">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong> Address:</strong>
                                <textarea class="form-control" style="height:150px" name="address" placeholder="Detail"></textarea>
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
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


@endsection
