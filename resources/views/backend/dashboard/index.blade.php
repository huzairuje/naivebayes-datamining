@extends('backend.layouts.app')

@section('title', $menu.' | ')

@section('content')
<section class="content-header">
    <h1>{!! $menu !!}</h1>
    {!! $breadcrumb !!}
</section>
<section class="content">
    <div class="box box-primary"></div>
</section>
@endsection
