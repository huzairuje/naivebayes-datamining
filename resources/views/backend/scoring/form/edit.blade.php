{!! Form::open(['route' => [$route.'.update', encodeids($data->id)], 'method' => 'PUT']) !!}
<div class="box-body">
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="control-label">{!! trans('label.name').trans('icon.mandatory') !!}</label>
            <input type="text" class="form-control" name="name" value="{!! old('name')!==null ? old('name') : $data->name !!}" placeholder="{!! trans('label.name_ph') !!}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! trans('button.edit') !!}</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('button.close') !!}</button>
</div>
{!! Form::close() !!}
