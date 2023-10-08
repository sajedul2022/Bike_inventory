@extends('layouts.app')
@section('title', 'Search')

@section('content')


    @if ($Searchs->isNotEmpty())
        <div class="table-responsive">
            <table style="width: 100%" class="table table-striped table-bordered ">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>product_code</th>
                    <th>model</th>
                    <th>reg_number</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($Searchs as $search)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $search->name }}</td>
                            <td>{{ $search->product_code }}</td>
                            <td>{{ $search->model }}</td>
                            <td>{{ $search->reg_number }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('products.show',$search->id) }}">View</a>
                            </td>
                            {{-- <td>{{ $search->status == 'active' ? 'Active' : 'Inactive'}}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <center class="mt-5">
                {{ $Searchs->withQueryString()->links() }}
            </center>
        </div>
    @else
        <div>
            <h2>Not found</h2>
        </div>
    @endif



@endsection
