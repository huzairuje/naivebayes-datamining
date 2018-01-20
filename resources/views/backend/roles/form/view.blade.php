<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.name') !!}</label>
            {!! Form::viewText($data->name) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.description') !!}</label>
            {!! Form::viewTextarea($data->description) !!}
        </div>
    </div>
</div>
<fieldset>
    <legend>{!! trans('label.list_of', ['name' => trans('label.role_privileges')]) !!}</legend>
    <div class="treemenu">
        {!! $treerole !!}
    </div>
</fieldset>
