<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('originalitas') ? ' has-error' : '' }}">
     {!! Form::label('originalitas', 'Originalitas',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('originalitas', null, ['class' => 'form-control', 'placeholder' => 'Originalitas']) !!}
      </div>
    {!! $errors->first('originalitas', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('kebaruan') ? ' has-error' : '' }}">
     {!! Form::label('kebaruan', 'Kebaruan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('kebaruan', null, ['class' => 'form-control', 'placeholder' => 'Kebaruan']) !!}
      </div>
    {!! $errors->first('kebaruan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('manfaat') ? ' has-error' : '' }}">
     {!! Form::label('manfaat', 'Manfaat',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('manfaat', null, ['class' => 'form-control', 'placeholder' => 'Manfaat']) !!}
      </div>
    {!! $errors->first('manfaat', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('clarity') ? ' has-error' : '' }}">
     {!! Form::label('clarity', 'Clarity dalam tulisan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('clarity', null, ['class' => 'form-control', 'placeholder' => 'Clarity dalam tulisan']) !!}
      </div>
    {!! $errors->first('clarity', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('kelengkapan_laporan') ? ' has-error' : '' }}">
     {!! Form::label('kelengkapan_laporan', 'Kelengkapan Laporan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('kelengkapan_laporan', null, ['class' => 'form-control', 'placeholder' => 'Kelengkapan Laporan']) !!}
      </div>
    {!! $errors->first('kelengkapan_laporan', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
