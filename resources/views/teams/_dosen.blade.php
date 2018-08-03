<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('nama_dosbing') ? ' has-error' : '' }}">
        {!! Form::label('nama_dosbing', 'Nama Dosen Pembimbing') !!}
        {!! Form::text('nama_dosbing', null, ['class' => 'form-control', 'placeholder' => 'Nama Dosen Pembimbing']) !!}
        {!! $errors->first('nama_dosbing', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('nidn') ? ' has-error' : '' }}">
        {!! Form::label('nidn', 'NIDN Dosen Pembimbing') !!}
        {!! Form::text('nidn', null, ['class' => 'form-control', 'placeholder' => 'NIDN Dosen Pembimbing']) !!}
        {!! $errors->first('nidn', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
