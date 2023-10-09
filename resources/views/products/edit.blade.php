@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="row">

            <div class="form-group">
                <label for="category_id">Category</label>

                <select class="form-control" name="category_id" required>
                    <option value="" disabled selected>Select</option>
                    @if ($categories)
                        @foreach ($categories as $category)
                            <?php $dash = ''; ?>
                            <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }} >{{ $category->name }}
                            </option>
                            @if (count($category->subcategory))
                                @include('categories/EditSubCategoryList-option', [
                                    'subcategories' => $category->subcategory,
                                ])
                            @endif
                        @endforeach
                    @endif
                </select>


            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Products:</strong>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                        placeholder="Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Manufacturer/Brand:</strong>
                    <input type="text" name="manufacturer" class="form-control"
                    value="{{ $product->manufacturer }}" placeholder="manufacturer Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Measurement Unit: </strong> <span>Like: PCS, Liter, KG etc. </span>
                    <input type="text" name="measurement_unit"  value="{{ $product->measurement_unit }}"  class="form-control" placeholder="Measurement Unit Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Model:</strong>
                    <input type="text" name="model"  value="{{ $product->model }}"  class="form-control" placeholder="Model Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Color: </strong>
                    <input type="text" name="color"  value="{{ $product->color }}"  class="form-control" placeholder="Color Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    <br>
                    {{-- <img src="/images/{{ $product->image }}" width="100px"> --}}
                    <img src="{{ asset('images/'.$product->image) }}" width="100px">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Details:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Chassis Number:</strong>
                    <input type="number" name="chassis_number"  value="{{ $product->chassis_number }}" class="form-control" placeholder="Chassis Number ">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Engine Number: </strong>
                    <input type="number" name="engine_number"  value="{{ $product->engine_number }}" class="form-control" placeholder="Engine Number">
                </div>
            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Registration Number: </strong>
                    <input type="text" name="reg_number"  value="{{ $product->reg_number }}" class="form-control" placeholder="Registration Number">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Registration Date: </strong>
                    <input type="date" name="reg_date" value="{{ $product->reg_date }}"  class="form-control" placeholder="Registration Date">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cubic Capacity (CC):</strong>
                    <input type="text" name="cubic_capacity" value="{{ $product->cubic_capacity }}"  class="form-control" placeholder="Cubic Capacity (CC) ">
                    </br>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    <p class="text-center text-primary"><small></small></p>
@endsection
