{!! Form::open(['route' => [$route.'.deactivate.post', encodeids($data->id)], 'method' => 'POST']) !!}
<div class="box-body">
    @include($view.'.form.view')
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-danger">{!! trans('button.deactivate') !!}</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('button.close') !!}</button>
</div>
{!! Form::close() !!}
