@extends('backend.layouts.app')

@section('title', $menu.' | ')

@section('content')
<section class="content-header">
    <h1>{!! $menu !!}</h1>
    {!! $breadcrumb !!}
</section>
<section class="content">
    <div class="box box-primary">
        @if (check_access('create', $slug))
        <div class="box-header with-border">
            <a data-href="{!! route($route.'.create') !!}" class="btn btn-primary btn-modal-form" title="{!! trans('label.create') !!}" data-title="{!! trans('form.create', ['menu' => $menu]) !!}" data-icon="fa fa-plus fa-fw" data-background="modal-primary">{!! trans('button.create') !!}</a>
        </div>
        @endif
        @include($view.'.form.table')
    </div>
</section>
@endsection

@push('scripts')
    @include($view.'.scripts')
@endpush
