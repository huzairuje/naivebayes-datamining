@extends('layouts.app')

@section('title', trans('label.title_box_reset_password').' | ')

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
            <h4>{!! trans('label.title_box_reset_password') !!}</h4>
        </div>
        {!! Form::open(['route' => 'auth::reset.password.post', 'method' => 'POST']) !!}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="{!! trans('label.email_ph') !!}" autofocus>
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
        <button type="submit" class="btn btn-primary btn-block">
            {!! trans('button.reset_password') !!}
        </button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
