<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.parent') !!}</label>
            {!! Form::viewText($data->parent) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.name') !!}</label>
            {!! Form::viewText($data->name) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">{!! trans('label.sequence') !!}</label>
                    {!! Form::viewStatic($data->sequence) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">{!! trans('label.sidebar') !!}</label>
                    {!! Form::viewStatic(print_show_hide($data->sidebar)) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">{!! trans('label.icon') !!}</label>
                    {!! Form::viewStatic(print_icon($data->icon)) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">{!! trans('label.url') !!}</label>
            {!! Form::viewText(!empty($data->slug) ? url($data->slug) : url('admin')) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">{!! trans('label.description') !!}</label>
            {!! Form::viewTextarea($data->description) !!}
        </div>
    </div>
</div>
