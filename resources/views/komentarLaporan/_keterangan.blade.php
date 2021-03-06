<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('status') ? ' has-error' : '' }}">
     {!! Form::label('status', 'Status',['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('status', null, ['class' => 'form-control', 'placeholder' => 'Status','required']) !!}
    </div> 
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('keterangan') ? ' has-error' : '' }}">
     {!! Form::label('keterangan', 'Keterangan',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('keterangan', null, ['class' => 'form-control', 'placeholder' => 'Keterangan','required']) !!}
    </div> 
    {!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('status') ? ' has-error' : '' }}">
        {!! Form::label('pengurus_id', 'Pemeriksa',['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::select('pengurus_id', App\Pengurus::pluck('nama_pengurus','id')->all(), null, ['class' => 'form-control js-select2','placeholder'=>'','required']) !!}
    </div> 
       {!! $errors->first('pengurus_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('laporan_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
