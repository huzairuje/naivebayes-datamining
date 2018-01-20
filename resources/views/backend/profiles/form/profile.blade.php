{!! Form::open(['route' => [$route.'.update', encodeids($user->id)], 'method' => 'PUT', 'files' => TRUE]) !!}
<div class="box-body">
    <input type="hidden" name="tab" value="profile">
    <input type="file" class="hidden" id="avatar" name="avatar">
    <input type="hidden" name="avatar_old" value="{!! $user->avatar !!}">
    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}{{ check_access('update', 'admin/user') ? '' : ' hidden' }}">
        <label class="control-label">{!! trans('label.role').trans('icon.mandatory') !!}</label>
        <select class="form-control select2" name="role" data-placeholder="{!! trans('label.role') !!}">
            <option></option>
            @foreach ($roles as $role)
                <option value="{!! $role->id !!}"{!! old('role')!==null ? (old('role')==$role->id ? ' selected' : '') : ($user->user_role()->first()->role_id==$role->id ? ' selected' : '') !!}>{!! $role->name !!}</option>
            @endforeach
        </select>
        @if ($errors->has('role'))
            <span class="help-block">
                <strong>{{ $errors->first('role') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label">{!! trans('label.name').trans('icon.mandatory') !!}</label>
        <input type="text" class="form-control" name="name" value="{!! old('name')!==null ? old('name') : $user->name !!}" placeholder="{!! trans('label.name_ph') !!}">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label">{!! trans('label.email') !!}</label>
        <input type="email" class="form-control" name="email" value="{!! old('email')!==null ? old('email') : $user->email !!}" placeholder="{!! trans('label.email_ph') !!}" readonly>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! trans('button.edit') !!}</button>
</div>
{!! Form::close() !!}
