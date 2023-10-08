@extends('layouts.app')
@section('title', 'Customer Due')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Customer Due </h2>
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
            <th>Sale Invoice </th>
            <th>Customer Name:</th>
            <th>Phone:</th>
            <th>Address:</th>
            <th>Total Amount:</th>
            <th>Paid:</th>
            <th>Due:</th>
            {{-- <th> Image </th> --}}

        </tr>
        @foreach ($CusDues as $CusDue)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $CusDue->sales_invoice_no }}</td>
                <td>{{ $CusDue->customer_name }}</td>
                <td>{{ $CusDue->phone }}</td>
                <td>{{ $CusDue->address }}</td>
                <td>{{ $CusDue->sales_total_amount }}</td>
                <td>{{ $CusDue->sales_amount_paid }}</td>
                <td>{{ $CusDue->sales_balance_due }}</td>
                {{-- <td><img src="/images/{{ $product->image }}" width="80px"></td> --}}
            </tr>
        @endforeach
    </table>
    {!! $CusDues->links() !!}
@endsection
