@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Supplier/Seller </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('suppliers.index') }}"> Back</a>
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
    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong> Supplier Name: </strong>
                    <input type="text" name="supplier_name" value="{{ $supplier->supplier_name }}" class="form-control"
                        placeholder="Customer Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Father Name:</strong>
                    <input type="text" name="father_name" value="{{ $supplier->father_name }}" class="form-control"
                        placeholder="Father Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email: </strong>
                    <input type="email" name="email" value="{{ $supplier->email }}" class="form-control"
                        placeholder="Email">
                </div>
            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Phone Number:</strong>
                    <input type="number" name="phone" value="{{ $supplier->phone }}" class="form-control"
                        placeholder="Phone Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nid Number: </strong>
                    <input type="text" name="nid" value="{{ $supplier->nid }}" class="form-control"
                        placeholder="Nid  Number">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Date Of Birth: </strong>
                    <input type="date" name="dob" value="{{ $supplier->dob }}" class="form-control" placeholder="Date of Birth">
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="nid_image" class="form-control" placeholder="image">
                    <br>
                    <img src="{{ asset('images/'.$supplier->nid_image) }}" width="100px">

                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong> Address:</strong>
                    <textarea class="form-control" style="height:150px" name="address" placeholder="Detail"> {{ $supplier->address }} </textarea>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Mediator Name:</strong>
                    <input type="text" name="mediator_name" value="{{ $supplier->mediator_name }}" class="form-control" placeholder="Mediator Name"> </br>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Mediator Phone:</strong>
                    <input type="number" name="mediator_phone" value="{{ $supplier->mediator_phone }}" class="form-control" placeholder="Mediator Phone "> </br>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
    </form>
    <p class="text-center text-primary"><small></small></p>
@endsection
