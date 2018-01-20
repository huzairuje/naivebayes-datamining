{!! Form::open(['route' => [$route.'.destroy', encodeids($data->id)], 'method' => 'DELETE']) !!}
<div class="box-body">
    @include($view.'.form.view')
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-danger">{!! trans('button.delete') !!}</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('button.close') !!}</button>
</div>
{!! Form::close() !!}
