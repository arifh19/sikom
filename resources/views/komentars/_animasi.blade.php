<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Ide_konsep_keaslian') ? ' has-error' : '' }}">
     {!! Form::label('Ide_konsep_keaslian', 'Ide Konsep Keaslian',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Ide_konsep_keaslian', null, ['class' => 'form-control', 'placeholder' => 'Ide Konsep Keaslian']) !!}
      </div>
    {!! $errors->first('Ide_konsep_keaslian', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Konsistensi_tema') ? ' has-error' : '' }}">
     {!! Form::label('Konsistensi_tema', 'Konsistensi Tema',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Konsistensi_tema', null, ['class' => 'form-control', 'placeholder' => 'Konsistensi Tema']) !!}
      </div>
    {!! $errors->first('Konsistensi_tema', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Kreativitas_dalam_implementasi') ? ' has-error' : '' }}">
     {!! Form::label('Kreativitas_dalam_implementasi', 'Kreativitas dalam implementasi',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Kreativitas_dalam_implementasi', null, ['class' => 'form-control', 'placeholder' => 'Kreativitas dalam implementasi']) !!}
      </div>
    {!! $errors->first('Kreativitas_dalam_implementasi', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Teknik_modelling_lighting_motion') ? ' has-error' : '' }}">
     {!! Form::label('Teknik_modelling_lighting_motion', 'Teknik (modelling,lighting,motion)',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Teknik_modelling_lighting_motion', null, ['class' => 'form-control', 'placeholder' => 'Teknik (modelling,lighting,motion)']) !!}
      </div>
    {!! $errors->first('Teknik_modelling_lighting_motion', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Kekuatan_pesan_artistik') ? ' has-error' : '' }}">
     {!! Form::label('Kekuatan_pesan_artistik', 'Kekuatan pesan artistik',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Kekuatan_pesan_artistik', null, ['class' => 'form-control', 'placeholder' => 'Kekuatan pesan artistik']) !!}
      </div>
    {!! $errors->first('Kekuatan_pesan_artistik', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
