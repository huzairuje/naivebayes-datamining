{!! Form::open(['route' => $route.'.store', 'method' => 'POST']) !!}
<div class="box-body">
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('penghasilan') ? ' has-error' : '' }}">
            <label class="control-label">Penghasilan</label>
            <select class="form-control select2" id="penghasilan" name="penghasilan" data-placeholder="Select Penghasilan">
                <option></option>
                @foreach($penghasilan as $key => $value)
                <option value="{!! $key !!}">{!! $value !!}</option>
                @endforeach
            </select>
            @if ($errors->has('penghasilan'))
                <span class="help-block">
                    <strong>{{ $errors->first('penghasilan') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('pengeluaran') ? ' has-error' : '' }}">
            <label class="control-label">Pengeluaran</label>
            <select class="form-control select2" id="pengeluaran" name="pengeluaran" data-placeholder="Select Pengeluaran">
                <option></option>
                @foreach($pengeluaran as $key => $value)
                <option value="{!! $key !!}">{!! $value !!}</option>
                @endforeach
            </select>
            @if ($errors->has('pengeluaran'))
                <span class="help-block">
                    <strong>{{ $errors->first('pengeluaran') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('pekerjaan') ? ' has-error' : '' }}">
            <label class="control-label">Penghasilan</label>
            <select class="form-control select2" id="pekerjaan" name="pekerjaan" data-placeholder="Select Pekerjaan">
                <option></option>
                @foreach($pekerjaan as $key => $value)
                <option value="{!! $key !!}">{!! $value !!}</option>
                @endforeach
            </select>
            @if ($errors->has('pekerjaan'))
                <span class="help-block">
                    <strong>{{ $errors->first('pekerjaan') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('status_kawin') ? ' has-error' : '' }}">
            <label class="control-label">Status Kawin</label>
            <select class="form-control select2" id="status_kawin" name="pengeluaran" data-placeholder="Select Status Kawin">
                <option></option>
                @foreach($status_kawin as $key => $value)
                <option value="{!! $key !!}">{!! $value !!}</option>
                @endforeach
            </select>
            @if ($errors->has('status_kawin'))
                <span class="help-block">
                    <strong>{{ $errors->first('status_kawin') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div id="score"></div>
    </div>
</div>
</div>
<div class="box-footer">
    <button type="button" id="hitung" class="btn btn-primary">Penilaian</button>
    <!-- <button type="submit" class="btn btn-primary">{!! trans('button.save') !!}</button> -->
    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('button.close') !!}</button> -->
</div>
{!! Form::close() !!}
