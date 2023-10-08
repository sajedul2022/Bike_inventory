@extends('layouts.app')
@section('title', 'Search View')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Back </a>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">

        {{-- Seller Info --}}

        <div class="col-xs-3 col-sm-3 col-md-3 box">

            <h1 class="display-4"> Seller Info </h1>
            <hr>

            <p class=""> Seller Name: {{ isset($supplier[0]->supplier_name) ? $supplier[0]->supplier_name : null }}
            </p>
            <p class=""> Father Name: {{ isset($supplier[0]->father_name) ? $supplier[0]->father_name : null }} </p>
            <p class="">Email: {{ isset($supplier[0]->email) ? $supplier[0]->email : null }} </p>
            <p class="">Phone: {{ isset($supplier[0]->phone) ? $supplier[0]->phone : null }} </p>
            <p class="">Date Of Birth: {{ isset($supplier[0]->dob) ? $supplier[0]->dob : null }} </p>
            <p class="">Address: {{ isset($supplier[0]->address) ? $supplier[0]->address : null }} </p>
            <p class="">NID NO: {{ isset($supplier[0]->nid) ? $supplier[0]->nid : null }} </p>
            <p class="">NID Image: <img
                    src="/images/{{ isset($supplier[0]->nid_image) ? $supplier[0]->nid_image : null }}" width="100px"
                    alt="NID IMG"> </p>
            <p class="">Mediator Name: {{ isset($supplier[0]->mediator_name) ? $supplier[0]->mediator_name : null }}
            </p>
            <p class="">Mediator Phone:
                {{ isset($supplier[0]->mediator_phone) ? $supplier[0]->mediator_phone : null }} </p>
        </div>

        {{-- Products info --}}

        <div class="col-xs-4 col-sm-4 col-md-4 ">
            <div class="jumbotron">
                <h1 class="display-4"> Products Info </h1>
                <hr>
                <p class=""> Category:
                    <select class="form-control" name="category_id" required>
                        <option value="" disabled selected>Select</option>
                        @if ($categories)
                            @foreach ($categories as $category)
                                <?php $dash = ''; ?>
                                <option value="{{ $category->id }} disabled selected "
                                    {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                                @if (count($category->subcategory))
                                    @include('categories/EditSubCategoryList-option', [
                                        'subcategories' => $category->subcategory,
                                    ])
                                @endif
                            @endforeach
                        @endif
                    </select>
                </p>
                <p class=""> Products Name: {{ $product->name }} </p>
                <p class=""> Products Code: {{ $product->product_code }} </p>
                <p> Manufacturer/Brand: {{ $product->manufacturer }}</p>
                <p> Measurement Unit: {{ $product->measurement_unit }}</p>
                <p> Model: {{ $product->model }} </p>
                <p> Color: {{ $product->color }} </p>
                <p> Details: {{ $product->detail }} </p>
                <p> Chassis Number: {{ $product->chassis_number }} </p>
                <p> Engine Number: {{ $product->engine_number }} </p>
                <p> Registration Number: {{ $product->reg_number }} </p>
                <p> Registration Date: {{ $product->reg_date }} </p>
                <p> Cubic Capacity (CC): {{ $product->cubic_capacity }} </p>

                <p> Image: <img src="/images/{{ $product->image }}" width="100px"> </p>
            </div>

        </div>

        {{-- Customer Info --}}

        <div class="col-xs-4 col-sm-4 col-md-4 box">

            <h1 class="display-4"> Customer Info </h1>
            <hr>
            <p class=""> Customer Name:
                {{ isset($customer[0]->customer_name) ? $customer[0]->customer_name : null }} </p>
            <p class=""> Father Name: {{ isset($customer[0]->father_name) ? $customer[0]->father_name : null }} </p>
            <p class="">Email: {{ isset($customer[0]->email) ? $customer[0]->email : null }} </p>
            <p class="">Phone: {{ isset($customer[0]->phone) ? $customer[0]->phone : null }} </p>
            <p class="">Date Of Birth: {{ isset($customer[0]->dob) ? $customer[0]->dob : null }} </p>
            <p class="">Address: {{ isset($customer[0]->address) ? $customer[0]->address : null }} </p>
            <p class="">NID NO: {{ isset($customer[0]->nid) ? $customer[0]->nid : null }} </p>
            <p class="">NID Image: <img
                    src="/images/{{ isset($customer[0]->nid_image) ? $customer[0]->nid_image : null }}" alt="NID IMG"
                    width="100px"> </p>
            <p class="">Mediator Name: {{ isset($customer[0]->mediator_name) ? $customer[0]->mediator_name : null }}
            </p>
            <p class="">Mediator Phone:
                {{ isset($customer[0]->mediator_phone) ? $customer[0]->mediator_phone : null }} </p>


        </div>


    </div>


@endsection
