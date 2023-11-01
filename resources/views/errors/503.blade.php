{{-- @extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable')) --}}


@extends('layouts.app')
@section('title', __('Service Unavailable'))

@section('content')

    <div>
        <a href="{{ route('home') }}" class="btn btn-primary"> Back </span></a>
        <a class=" btn btn-primary" href="{{ route('clear') }}"> {{ __('Refresh') }} </a>
    </div>

@endsection
