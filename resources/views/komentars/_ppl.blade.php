<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Aspek_Inovasi') ? ' has-error' : '' }}">
     {!! Form::label('Aspek_Inovasi', 'Aspek Inovasi',['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Aspek_Inovasi', null, ['class' => 'form-control', 'placeholder' => 'Aspek Inovasi','required']) !!}
    </div> 
    {!! $errors->first('Aspek_Inovasi', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Dampak_pengguna_masyarakat') ? ' has-error' : '' }}">
     {!! Form::label('Dampak_pengguna_masyarakat', 'Dampak penggunaan ke masyarakat dan potensi sustainability',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Dampak_pengguna_masyarakat', null, ['class' => 'form-control', 'placeholder' => 'Dampak penggunaan ke masyarakat dan potensi sustainability','required']) !!}
    </div> 
    {!! $errors->first('Dampak_pengguna_masyarakat', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Desain_dan_usability') ? ' has-error' : '' }}">
     {!! Form::label('Desain_dan_usability', 'Desain antarmuka, usability dan UX',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Desain_dan_usability', null, ['class' => 'form-control', 'placeholder' => 'Desain antarmuka, usability dan UX','required']) !!}
    </div> 
    {!! $errors->first('Desain_dan_usability', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('metodologi_pengembangan') ? ' has-error' : '' }}">
     {!! Form::label('metodologi_pengembangan', 'Metodologi Pengembangan',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('metodologi_pengembangan', null, ['class' => 'form-control', 'placeholder' => 'Metodologi Pengembangan','required']) !!}
    </div> 
    {!! $errors->first('metodologi_pengembangan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Kesesuaian_ide') ? ' has-error' : '' }}">
     {!! Form::label('Kesesuaian_ide', 'Kesesuaian Ide',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Kesesuaian_ide', null, ['class' => 'form-control', 'placeholder' => 'Kesesuaian Ide','required']) !!}
    </div> 
    {!! $errors->first('Kesesuaian_ide', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Urgensi_permasalahan') ? ' has-error' : '' }}">
     {!! Form::label('Urgensi_permasalahan', 'Urgensi Permasalahan yang diangkat',['class' => 'col-sm-10 control-label']) !!}
    <div class="col-sm-12">
        {!! Form::text('Urgensi_permasalahan', null, ['class' => 'form-control', 'placeholder' => 'Urgensi Permasalahan yang diangkat','required']) !!}
    </div> 
    {!! $errors->first('Urgensi_permasalahan', '<p class="help-block">:message</p>') !!}
    </div>
    @include('komentars._dokumen') 
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
