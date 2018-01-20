@extends('layouts.app')

@section('body-class', 'class="hold-transition skin-blue fixed sidebar-mini"')

@section('styles')
    @include('backend.layouts.styles')
@endsection

@section('scripts')
    @include('backend.layouts.scripts')
@endsection

@section('wrapper')
    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')
    <div class="content-wrapper">
        @include('flash::message')
        @yield('content')
    </div>
    @include('backend.layouts.footer')
    @include('backend.layouts.modals.form')
    @include('backend.layouts.modals.action')
@endsection
