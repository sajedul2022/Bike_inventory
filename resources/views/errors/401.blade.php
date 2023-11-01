{{-- @extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized')) --}}

@extends('layouts.app')
@section('title', __('Unauthorized'))

@section('content')

    <div>
        <a href="{{ route('home') }}" class="btn btn-primary"> Back </span></a>
        <a class=" btn btn-primary" href="{{ route('clear') }}"> {{ __('Refresh') }} </a>
    </div>

@endsection
