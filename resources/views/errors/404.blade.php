@extends('errors::minimal')
@extends('layouts.app')
@section('title', __('Not Found'))

@section('content')

    <div>
        <a href="{{ route('home') }}" class="btn btn-primary"> Back </span></a>
        <a class=" btn btn-primary" href="{{ route('clear') }}"> {{ __('Refresh') }} </a>
   </div>

@endsection
{{--
@section('code', '404')
@section('message', __('Not Found!!!')) --}}
