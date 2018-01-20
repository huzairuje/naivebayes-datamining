@extends('layouts.app')

@section('title', trans('label.title_box_forgot_password').' | ')

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
            <h4>{!! trans('label.title_box_forgot_password') !!}</h4>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        {!! Form::open(['route' => 'auth::forgot.password.post', 'method' => 'POST']) !!}
        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{!! trans('label.email_ph') !!}" autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary btn-block">
            {!! trans('button.send') !!}
        </button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
