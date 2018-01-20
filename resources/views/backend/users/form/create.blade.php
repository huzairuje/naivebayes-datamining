{!! Form::open(['route' => $route.'.store', 'method' => 'POST']) !!}
<div class="box-body">
    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        <label class="control-label">{!! trans('label.role').trans('icon.mandatory') !!}</label>
        <select class="form-control select2" name="role" data-placeholder="{!! trans('label.role') !!}" autofocus>
            <option></option>
            @foreach ($roles as $role)
                <option value="{!! $role->id !!}"{!! old('role')==$role->id ? ' selected' : '' !!}>{!! $role->name !!}</option>
            @endforeach
        </select>
        @if ($errors->has('role'))
            <span class="help-block">
                <strong>{!! $errors->first('role') !!}</strong>
            </span>
        @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="control-label">{!! trans('label.name').trans('icon.mandatory') !!}</label>
                <input type="text" class="form-control" name="name" value="{!! old('name') !!}" placeholder="{!! trans('label.name_ph') !!}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{!! $errors->first('name') !!}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label">{!! trans('label.email').trans('icon.mandatory') !!}</label>
                <input type="email" class="form-control" name="email" value="{!! old('email') !!}" placeholder="{!! trans('label.email_ph') !!}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{!! $errors->first('email') !!}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label">{!! trans('label.password').trans('icon.mandatory') !!}</label>
                <input type="password" class="form-control" name="password" placeholder="{!! trans('label.password_ph') !!}">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{!! $errors->first('password') !!}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
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
    </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! trans('button.save') !!}</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('button.close') !!}</button>
</div>
{!! Form::close() !!}
