<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('konten') ? ' has-error' : '' }}">
     {!! Form::label('konten', 'Kreativitas',['class' => 'col-sm-2 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('konten', null, ['class' => 'form-control', 'placeholder' => 'Kreativitas']) !!}
      </div>
        {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
    {!! $errors->first('konten', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
