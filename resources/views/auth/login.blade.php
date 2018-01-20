@extends('layouts.app')

@section('title', trans('label.title_box_login').' | ')

@section('body-class', 'class="hold-transition login-page"')

@section('styles')
    @include('backend.layouts.styles')
@endsection

@section('scripts')
    @include('backend.layouts.scripts')
@endsection

@section('wrapper')
<div class="login-box">
    <div class="login-logo">
        <a href="{!! route('welcome') !!}">{!! trans('app.logo') !!}</a>
    </div>
    <div class="login-box-body">
        <div class="page-header text-center">
            <h4>{!! trans('label.title_box_login') !!}</h4>
        </div>
        {!! Form::open(['route' => 'auth::login.post', 'method' => 'POST']) !!}
        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{!! trans('label.email_ph') !!}" autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password" placeholder="{!! trans('label.password_ph') !!}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember"> {!! trans('label.remember_me') !!}
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
                {!! trans('button.login') !!}
            </button>
        </div>
        {!! Form::close() !!}
        <ul class="nav nav-pills nav-justified">
            <li><a href="{!! route('auth::forgot.password.get') !!}">{!! trans('button.forgot_password') !!}</a></li>
            <li><a href="{!! route('auth::register.get') !!}">{!! trans('button.register') !!}</a></li>
        </ul>
    </div>
</div>
@endsection
