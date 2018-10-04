<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Permasalahan_yang_diangkat') ? ' has-error' : '' }}">
     {!! Form::label('Permasalahan_yang_diangkat', 'Permasalahan yang diangkat',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Permasalahan_yang_diangkat', null, ['class' => 'form-control', 'placeholder' => 'Permasalahan yang diangkat','required']) !!}
      </div>
    {!! $errors->first('Permasalahan_yang_diangkat', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Pemaparan_permasalahan') ? ' has-error' : '' }}">
     {!! Form::label('Pemaparan_permasalahan', 'Pemaparan permasalahan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Pemaparan_permasalahan', null, ['class' => 'form-control', 'placeholder' => 'Pemaparan permasalahan','required']) !!}
      </div>
    {!! $errors->first('Pemaparan_permasalahan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Dampak_implementasi') ? ' has-error' : '' }}">
     {!! Form::label('Dampak_implementasi', 'Dampak implementasi',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Dampak_implementasi', null, ['class' => 'form-control', 'placeholder' => 'Dampak Implementasi','required']) !!}
      </div>
    {!! $errors->first('Dampak_implementasi', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Inovasi_pengembangan') ? ' has-error' : '' }}">
     {!! Form::label('Inovasi_pengembangan', 'Inovasi Pengembangan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Inovasi_pengembangan', null, ['class' => 'form-control', 'placeholder' => 'Inovasi Pengembangan','required']) !!}
      </div>
    {!! $errors->first('Inovasi_pengembangan', '<p class="help-block">:message</p>') !!}
    </div>
    {{-- @include('komentars._dokumen')  --}}
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
