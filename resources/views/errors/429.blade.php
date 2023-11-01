{{-- @extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests')) --}}


@extends('layouts.app')
@section('title', __('Too Many Requests'))

@section('content')

    <div>
        <a href="{{ route('home') }}" class="btn btn-primary"> Back </span></a>
        <a class=" btn btn-primary" href="{{ route('clear') }}"> {{ __('Refresh') }} </a>
    </div>

@endsection
