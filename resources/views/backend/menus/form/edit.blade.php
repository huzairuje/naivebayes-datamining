{!! Form::open(['route' => [$route.'.update', encodeids($data->id)], 'method' => 'PUT']) !!}
<div class="box-body">
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('parent') ? ' has-error' : '' }}">
            <label class="control-label">{!! trans('label.parent') !!}</label>
            <select class="form-control select2" name="parent" data-placeholder="{!! trans('label.parent') !!}">
                <option></option>
                @foreach ($parents as $parent)
                    <option value="{!! $parent->id !!}"{!! old('parent')!==null ? (old('parent')==$parent->id ? ' selected' : '') : ($data->parent_id==$parent->id ? ' selected' : '') !!}>{!! $parent->name !!}</option>
                @endforeach
            </select>
            @if ($errors->has('parent'))
                <span class="help-block">
                    <strong>{{ $errors->first('parent') }}</strong>
                </span>
            @endif
        </div>
    </div>
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
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('sequence') ? ' has-error' : '' }}">
            <label class="control-label">{!! trans('label.sequence').trans('icon.mandatory') !!}</label>
            <input type="number" class="form-control" name="sequence" value="{!! old('sequence')!==null ? old('sequence') : $data->sequence !!}" placeholder="{!! trans('label.sequence_ph') !!}">
            @if ($errors->has('sequence'))
                <span class="help-block">
                    <strong>{{ $errors->first('sequence') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('sidebar') ? ' has-error' : '' }}">
            <label class="control-label">{!! trans('label.sidebar') !!}</label>
            <div class="form-control-static">
                <label class="radio-inline">
                    <input type="radio" name="sidebar" value="1"{!! old('sidebar')!==null ? (old('sidebar')==1 ? ' checked' : '') : ($data->sidebar==1 ? ' checked' : '') !!}> {!! trans('label.yes') !!}
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sidebar" value="0"{!! old('sidebar')!==null ? (old('sidebar')==0 ? ' checked' : '') : ($data->sidebar==0 ? ' checked' : '') !!}> {!! trans('label.no') !!}
                </label>
            </div>
            @if ($errors->has('sidebar'))
                <span class="help-block">
                    <strong>{{ $errors->first('sidebar') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label class="control-label">{!! trans('label.description') !!}</label>
            <textarea class="form-control" name="description" placeholder="{!! trans('label.description_ph') !!}" rows="4">{!! old('description')!==null ? old('description') : $data->description !!}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
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
