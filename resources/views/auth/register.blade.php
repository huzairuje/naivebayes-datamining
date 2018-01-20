@extends('layouts.app')

@section('title', trans('label.title_box_register').' | ')

@section('body-class', 'class="hold-transition register-page"')

@section('styles')
    @include('backend.layouts.styles')
@endsection

@section('scripts')
    @include('backend.layouts.scripts')
@endsection

@section('wrapper')
<div class="register-box">
    <div class="register-logo">
        <a href="{!! route('welcome') !!}">{!! trans('app.logo') !!}</a>
    </div>
    <div class="register-box-body">
        <div class="page-header text-center">
            <h4>{!! trans('label.title_box_register') !!}</h4>
        </div>
        {!! Form::open(['route' => 'auth::register.post', 'method' => 'POST']) !!}
        <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{!! trans('label.fullname_ph') !!}" autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{!! $errors->first('name') !!}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{!! trans('label.email_ph') !!}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{!! $errors->first('email') !!}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password" placeholder="{!! trans('label.password_ph') !!}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{!! $errors->first('password') !!}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password_confirmation" placeholder="{!! trans('label.password_confirmation_ph') !!}">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{!! $errors->first('password_confirmation') !!}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox"> I agree to the <a href="javascript:void(0);">terms</a>
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
                {!! trans('button.register') !!}
            </button>
        </div>
        {!! Form::close() !!}
        <ul class="nav nav-pills nav-justified">
            <li><a href="{!! route('auth::login.get') !!}">{!! trans('button.login') !!}</a></li>
        </ul>
    </div>
</div>
@endsection
