{{-- @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired')) --}}


@extends('layouts.app')
@section('title', __('Page Expired'))

@section('content')

    <div>
        <a href="{{ route('home') }}" class="btn btn-primary"> Back </span></a>
        <a class=" btn btn-primary" href="{{ route('clear') }}"> {{ __('Refresh') }} </a>
    </div>

@endsection
