<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('judul') ? ' has-error' : '' }}">
     {!! Form::label('judul', 'Kesesuaian isi dan judul artikel',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('judul', null, ['class' => 'form-control', 'placeholder' => 'Kesesuaian isi dan judul artikel','required']) !!}
      </div>
    {!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('abstrak') ? ' has-error' : '' }}">
     {!! Form::label('abstrak', 'Abstrak',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('abstrak', null, ['class' => 'form-control', 'placeholder' => 'Abstrak','required']) !!}
      </div>
    {!! $errors->first('abstrak', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('pendahuluan') ? ' has-error' : '' }}">
     {!! Form::label('pendahuluan', 'Pendahuluan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('pendahuluan', null, ['class' => 'form-control', 'placeholder' => 'Pendahuluan','required']) !!}
      </div>
    {!! $errors->first('pendahuluan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('tujuan') ? ' has-error' : '' }}">
     {!! Form::label('tujuan', 'Tujuan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('tujuan', null, ['class' => 'form-control', 'placeholder' => 'Tujuan','required']) !!}
      </div>
    {!! $errors->first('tujuan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('metode') ? ' has-error' : '' }}">
     {!! Form::label('metode', 'Metode',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('metode', null, ['class' => 'form-control', 'placeholder' => 'Metode','required']) !!}
      </div>
    {!! $errors->first('metode', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('hasil_pembahasan') ? ' has-error' : '' }}">
     {!! Form::label('hasil_pembahasan', 'Hasil dan Pembahasan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('hasil_pembahasan', null, ['class' => 'form-control', 'placeholder' => 'Hasil dan Pembahasan','required']) !!}
      </div>
    {!! $errors->first('hasil_pembahasan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('kesimpulan') ? ' has-error' : '' }}">
     {!! Form::label('kesimpulan', 'Kesimpulan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('kesimpulan', null, ['class' => 'form-control', 'placeholder' => 'Kesimpulan','required']) !!}
      </div>
    {!! $errors->first('kesimpulan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('daftar_pustaka') ? ' has-error' : '' }}">
     {!! Form::label('daftar_pustaka', 'Daftar Pustaka',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('daftar_pustaka', null, ['class' => 'form-control', 'placeholder' => 'Daftar Pustaka','required']) !!}
      </div>
    {!! $errors->first('daftar_pustaka', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
