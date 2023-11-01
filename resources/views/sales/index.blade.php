@extends('layouts.app')
@section('title', 'All Sales')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Sales </h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                    <a class="btn btn-success" href="{{ route('sales.create') }}"> New Sales </a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Product Reg </th>
                <th> Sales Invoice </th>
                <th>Sales Rate:</th>
                <th>Sales Quantity:</th>
                <th>Sale Price:</th>
                {{-- <th> Image </th> --}}
                <th width="280px">Action</th>
            </tr>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                        @foreach ($products as $product)
                            {{-- {{ $sale->product_id }} --}}
                            {{ $sale->product_id === $product->id ? $product->reg_number : '' }}
                        @endforeach
                    </td>
                    <td>{{ $sale->sales_invoice_no }}</td>
                    <td>{{ $sale->sale_price }}</td>
                    <td>{{ $sale->sales_quantity }}</td>
                    <td>{{ $sale->sales_total_amount }}</td>
                    {{-- <td><img src="{{ asset('images/'.$product->image) }}" width="80px"></td> --}}
                    <td>

                        <a class="btn btn-info" href="{{ route('sales.show', $sale->id) }}">Invoice</a>
                        @can('sales-edit')
                            <a class="btn btn-primary" href="{{ route('sales.edit', $sale->id) }}">Edit</a>
                        @endcan

                        {{-- <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('sales-delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form> --}}

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $sales->links() !!}
@endsection
