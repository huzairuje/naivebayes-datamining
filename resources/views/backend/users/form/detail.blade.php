{!! Form::open() !!}
<div class="box-body">
    @include($view.'.form.view')
</div>
<div class="box-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('button.close') !!}</button>
</div>
{!! Form::close() !!}
