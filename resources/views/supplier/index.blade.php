@extends('layouts.app')
@section('title', 'All Products')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Suppliers </h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('suppliers.create') }}">  New Suppliers </a>
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
            <th>Suppliers Name</th>
            <th>Phone :</th>
            <th> Address </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($suppliers as $supplier)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $supplier->supplier_name }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->address }}</td>

            <td>
                <form action="{{ route('suppliers.destroy',$supplier->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a> --}}
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Deactive</a> --}}
                    @can('supplier-edit')
                    <a class="btn btn-primary" href="{{ route('suppliers.edit',$supplier->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('supplier-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $suppliers->links() !!}
    <p class="text-center text-primary"><small></small></p>
@endsection
