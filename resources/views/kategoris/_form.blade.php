<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('nama_kategori') ? ' has-error' : '' }}">
     {!! Form::label('nama_kategori', 'Kategori') !!}

    {!! Form::text('nama_kategori', null, ['class' => 'form-control', 'placeholder' => 'Nama Kategori']) !!}
    {!! $errors->first('nama_kategori', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
