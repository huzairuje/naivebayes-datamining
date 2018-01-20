@extends('frontend.layouts.app')

@section('title', $menu.' | ')

@section('content')
<div class="page-header">
    <h1>{!! $menu !!}</h1>
</div>
@endsection
