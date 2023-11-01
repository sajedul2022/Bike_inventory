{{-- @extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error')) --}}



@extends('layouts.app')
@section('title', __('Server Error'))

@section('content')

    <div>
        <a href="{{ route('home') }}" class="btn btn-primary"> Back </span></a>
        <a class=" btn btn-primary" href="{{ route('clear') }}"> {{ __('Refresh') }} </a>
    </div>

@endsection
