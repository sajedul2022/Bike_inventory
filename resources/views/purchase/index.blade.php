@extends('layouts.app')
@section('title', 'All Purchase')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Purchase </h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                    <a class="btn btn-success" href="{{ route('purchase.create') }}"> New Purchase </a>
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
                <th>Purchase Invoice </th>
                <th>purchase_rate:</th>
                <th>purchase_quantity:</th>
                <th>Total Price:</th>
                {{-- <th> Image </th> --}}
                <th width="280px">Action</th>
            </tr>
            @foreach ($purchases as $purchase)
                <tr>
                    <td>{{ ++$i }}</td>

                    <td>
                        {{-- {{ $purchase->product_id }} --}}
                        @foreach ($products as $product)
                            {{ $purchase->product_id === $product->id ? $product->reg_number : '' }}
                        @endforeach

                    </td>

                    <td>{{ $purchase->purchase_invoice_no }}</td>
                    <td>{{ $purchase->purchase_rate }}</td>
                    <td>{{ $purchase->purchase_quantity }}</td>
                    <td>{{ $purchase->purchase_total_amount }}</td>
                    {{-- <td><img src="{{ asset('images/'.$product->image) }}" width="80px"></td> --}}
                    <td>

                        <a class="btn btn-info" href="{{ route('purchase.show', $purchase->id) }}">Invoice</a>
                        @can('Purchase-edit')
                            <a class="btn btn-primary" href="{{ route('purchase.edit', $purchase->id) }}">Edit</a>
                        @endcan

                        {{-- <form action="{{ route('purchase.destroy', $purchase->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('Purchase-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form> --}}

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $purchases->links() !!}
@endsection
