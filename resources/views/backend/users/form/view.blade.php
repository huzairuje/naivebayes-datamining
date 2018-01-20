<div class="form-group">
    <label class="control-label">{!! trans('label.role') !!}</label>
    {!! Form::viewText($data->role) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.name') !!}</label>
            {!! Form::viewText($data->name) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.email') !!}</label>
            {!! Form::viewText($data->email) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.join_date') !!}</label>
            {!! Form::viewText($data->join_date) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.status') !!}</label>
            {!! Form::viewText($data->active) !!}
        </div>
    </div>
</div>
