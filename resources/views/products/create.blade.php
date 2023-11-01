@extends('layouts.app')
@section('title', 'Products Create')

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
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="category_id"> Category </label>
                    <select class="form-control" name="category_id" required>

                        <option value="" disabled selected>Select</option>
                        @if ($categories)
                            @foreach ($categories as $category)
                                <?php $dash = ''; ?>
                                <option value="{{ $category->id }}">{{ $category->name }}
                                </option>
                                @if (count($category->subcategory))
                                    @include('categories/subCategoryList-option', [
                                        'subcategories' => $category->subcategory,
                                    ])
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Manufacturer/Brand:</strong>
                    <input type="text" name="manufacturer" class="form-control" placeholder="manufacturer Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Measurement Unit: </strong> <span>Like: PCS, Liter, KG etc. </span>
                    <input type="text" name="measurement_unit" class="form-control" placeholder="Measurement Unit Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Model:</strong>
                    <input type="text" name="model" class="form-control" placeholder="Model Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Color: </strong>
                    <input type="text" name="color" class="form-control" placeholder="Color Name">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Chassis Number:</strong>
                    <input type="text" name="chassis_number" class="form-control" placeholder="Chassis Number ">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Engine Number: </strong>
                    <input type="text" name="engine_number" class="form-control" placeholder="Engine Number">
                </div>
            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Registration Number: </strong>
                    <input type="text" name="reg_number" class="form-control" placeholder="Registration Number">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Registration Date: </strong>
                    <input type="date" name="reg_date" class="form-control" placeholder="Registration Date">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cubic Capacity (CC):</strong>
                    <input type="text" name="cubic_capacity" class="form-control" placeholder="Cubic Capacity (CC) ">
                    </br>
                </div>
            </div>

            {{-- auth_id, product_code, category_id, name, manufacturer, measurement_unit, detail, image, model, color, chassis_number, engine_number, cubic_capacity, reg_number, reg_date, product_status --}}


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
