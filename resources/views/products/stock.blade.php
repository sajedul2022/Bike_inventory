@extends('layouts.app')
@section('title', 'Products Stock')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products Stock </h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Products Name</th>
            <th>Products Code</th>
            <th>Manufacturer</th>
            <th>Reg No</th>
            <th>Stock</th>

        </tr>
        @foreach ($stocks as $stock)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->product_code }}</td>
            <td>{{ $stock->manufacturer }}</td>
            <td>{{ $stock->reg_number }}</td>
            <td>{{ $stock->product_stock }}</td>


        </tr>
        @endforeach
    </table>
    {!! $stocks->links() !!}

@endsection
