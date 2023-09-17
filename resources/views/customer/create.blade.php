@extends('layouts.app')
@section('title', 'Create')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New </h2>
            </div>
            <div class="">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>

            </br>

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
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            {{-- 'customer_name', 'father_name', 'email', 'phone', 'nid', 'nid_image', 'address' --}}

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Customer Name:</strong>
                    <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">

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
                    <strong>Nid Number: </strong>
                    <input type="text" name="nid" class="form-control" placeholder="Nid  Number">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nid Image:</strong>
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
    <p class="text-center text-primary"><small></small></p>
@endsection