@extends('layouts.app')

@section('styles')
    @include('frontend.layouts.styles')
@endsection

@section('scripts')
    @include('frontend.layouts.scripts')
@endsection

@section('wrapper')
    @include('frontend.layouts.header')
    <div class="content-wrapper">
        <div class="container">
            @yield('content')
        </div>
    </div>
@endsection
