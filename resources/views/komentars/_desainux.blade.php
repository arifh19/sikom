<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Identifikasi_permasalahan') ? ' has-error' : '' }}">
     {!! Form::label('Identifikasi_permasalahan', 'Identifikasi Permasalahan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Identifikasi_permasalahan', null, ['class' => 'form-control', 'placeholder' => 'Identifikasi Permasalahan']) !!}
      </div>
    {!! $errors->first('Identifikasi_permasalahan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Inovasi_desain') ? ' has-error' : '' }}">
     {!! Form::label('Inovasi_desain', 'Inovasi Desain',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Inovasi_desain', null, ['class' => 'form-control', 'placeholder' => 'Inovasi Desain']) !!}
    </div>
    {!! $errors->first('Inovasi_desain', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Metode_Desain') ? ' has-error' : '' }}">
     {!! Form::label('Metode_Desain', 'Metode Desain',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Metode_Desain', null, ['class' => 'form-control', 'placeholder' => 'Metode Desain']) !!}
    </div>
    {!! $errors->first('Metode_Desain', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Prototype') ? ' has-error' : '' }}">
     {!! Form::label('Prototype', 'Low Fidelity Prototype',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Prototype', null, ['class' => 'form-control', 'placeholder' => 'Low Fidelity Prototype']) !!}
    </div>
    {!! $errors->first('Prototype', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Komunikasi') ? ' has-error' : '' }}">
     {!! Form::label('Komunikasi', 'Komunikasi (Proposal, Poster, Video)',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Komunikasi', null, ['class' => 'form-control', 'placeholder' => 'Komunikasi (Proposal, Poster, Video)']) !!}
    </div>
    {!! $errors->first('Komunikasi', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
