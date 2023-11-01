@extends('layouts.app')
@section('title', 'All Products')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>All Customers </h2>
        </div>
        <div class="pull-right">
            @can('product-create')
            <a class="btn btn-success" href="{{ route('customers.create') }}"> New Customers </a>
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
            <th>Customers Name</th>
            <th>Phone:</th>
            <th> Address </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $customer->customer_name }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->address }}</td>
            <td>
                <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a> --}}
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Deactive</a> --}}
                    @can('customer-edit')
                    <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('customer-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
{!! $customers->links() !!}
<p class="text-center text-primary"><small></small></p>
@endsection