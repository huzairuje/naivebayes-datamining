{!! Form::open(['route' => [$route.'.update', encodeids($user->id)], 'method' => 'PUT']) !!}
<div class="box-body">
    <input type="hidden" name="tab" value="change-password">
    <div class="form-group{{ $errors->has('password_old') ? ' has-error' : '' }}">
        <label class="control-label">{!! trans('label.password_old').trans('icon.mandatory') !!}</label>
        <input type="password" class="form-control" name="password_old" placeholder="{!! trans('label.password_old_ph') !!}">
        @if ($errors->has('password_old'))
            <span class="help-block">
                <strong>{!! $errors->first('password_old') !!}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label">{!! trans('label.password').trans('icon.mandatory') !!}</label>
        <input type="password" class="form-control" name="password" placeholder="{!! trans('label.password_ph') !!}">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{!! $errors->first('password') !!}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="control-label">{!! trans('label.password_confirmation').trans('icon.mandatory') !!}</label>
        <input type="password" class="form-control" name="password_confirmation" placeholder="{!! trans('label.password_confirmation_ph') !!}">
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{!! $errors->first('password_confirmation') !!}</strong>
            </span>
        @endif
    </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! trans('button.edit') !!}</button>
</div>
{!! Form::close() !!}
