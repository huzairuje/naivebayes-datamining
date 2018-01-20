@extends('backend.layouts.app')

@section('title', $menu.' | ')

@section('content')
<section class="content-header">
    <h1>{!! $menu !!}</h1>
    {!! $breadcrumb !!}
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="profile-user-img-wrapper">
                        <img class="profile-user-img img-responsive img-circle" {!! $user->avatar ? 'src="'.asset($user->avatar).'"' : 'data-src="holder.js/150x150?text=Avatar"' !!}>
                        <div class="change-avatar">
                            <span class="icon"></span>
                            <span class="text">{!! trans('label.change') !!}</span>
                        </div>
                    </div>
                    @if ($errors->has('avatar'))
                        <p class="text-center text-danger">
                            <strong>{{ $errors->first('avatar') }}</strong>
                        </p>
                    @endif
                    <h3 class="profile-username text-center">{!! $user->name !!}</h3>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('label.activity') !!}</h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-history fa-fw"></i> {!! trans('label.last_login') !!}</strong>
                    <p class="text-muted">{!! \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() !!}</p>
                    <hr>
                    <strong><i class="fa fa-desktop fa-fw"></i> {!! trans('label.ip_address') !!}</strong>
                    <p class="text-muted">{!! $user->last_login_ip !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li{!! request()->input('active')=='profile' || !request()->input('active') ? ' class="active"' : '' !!}><a href="#profile" data-toggle="tab">{!! trans('label.profile') !!}</a></li>
                    <li{!! request()->input('active')=='change-password' ? ' class="active"' : '' !!}><a href="#change-password" data-toggle="tab">{!! trans('label.change_password') !!}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane{!! request()->input('active')=='profile' || !request()->input('active') ? ' active' : '' !!}" id="profile">
                        @include($view.'.form.profile')
                    </div>
                    <div class="tab-pane{!! request()->input('active')=='change-password' ? ' active' : '' !!}" id="change-password">
                        @include($view.'.form.change_password')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    @include($view.'.scripts')
@endpush
