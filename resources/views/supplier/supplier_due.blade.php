@extends('layouts.app')
@section('title', 'Seller Due')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Seller Due </h2>
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
            <th>Purchase Invoice </th>
            <th>Seller Name:</th>
            <th>Phone:</th>
            <th>Address:</th>
            <th>Total Amount:</th>
            <th>Paid:</th>
            <th>Due:</th>
            {{-- <th> Image </th> --}}

        </tr>
        @foreach ($suppDues as $suppDue)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $suppDue->purchase_invoice_no }}</td>
                <td>{{ $suppDue->supplier_name }}</td>
                <td>{{ $suppDue->phone }}</td>
                <td>{{ $suppDue->address }}</td>
                <td>{{ $suppDue->purchase_total_amount }}</td>
                <td>{{ $suppDue->purchase_amount_paid }}</td>
                <td>{{ $suppDue->purchase_balance_due }}</td>
                {{-- <td><img src="{{ asset('images/'.$supplier->nid_image) }}" width="80px"></td> --}}
            </tr>
        @endforeach
    </table>
    {!! $suppDues->links() !!}
@endsection
