@extends('layouts.app')
@section('title', 'All Products')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Products </h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}">  New Products </a>
                @endcan
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
            <th>Products</th>
            <th>Products Code</th>
            <th>Measurement Unit:</th>
            <th> Image </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->product_code }}</td>
            <td>{{ $product->measurement_unit }}</td>

            <td><img src="{{ asset('images/'.$product->image) }}" width="80px"></td>
            {{-- <p class="text-muted">{{ $product->category ? $product->category->name : 'Uncategorized' }}</p> --}}
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a> --}}
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Deactive</a> --}}
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $products->links() !!}
    <p class="text-center text-primary"><small></small></p>
@endsection
