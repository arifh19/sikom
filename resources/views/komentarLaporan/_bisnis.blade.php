<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Penjelasan_Problem_Bisnis') ? ' has-error' : '' }}">
     {!! Form::label('Penjelasan_Problem_Bisnis', 'Penjelasan Problem Bisnis',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Penjelasan_Problem_Bisnis', null, ['class' => 'form-control', 'placeholder' => 'Penjelasan Problem Bisnis','required']) !!}
      </div>
    {!! $errors->first('Penjelasan_Problem_Bisnis', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Produk_Layanan') ? ' has-error' : '' }}">
     {!! Form::label('Produk_Layanan', 'Produk atau Layanan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Produk_Layanan', null, ['class' => 'form-control', 'placeholder' => 'Produk atau Layanan','required']) !!}
      </div>
    {!! $errors->first('Produk_Layanan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Pasar_Market') ? ' has-error' : '' }}">
     {!! Form::label('Pasar_Market', 'Pasar/Market',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Pasar_Market', null, ['class' => 'form-control', 'placeholder' => 'Pasar/Market','required']) !!}
      </div>
    {!! $errors->first('Pasar_Market', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Strategi_Bisnis') ? ' has-error' : '' }}">
     {!! Form::label('Strategi_Bisnis', 'Strategi Bisnis',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Strategi_Bisnis', null, ['class' => 'form-control', 'placeholder' => 'Strategi Bisnis','required']) !!}
      </div>
    {!! $errors->first('Strategi_Bisnis', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Anggota_Perusahaan') ? ' has-error' : '' }}">
     {!! Form::label('Anggota_Perusahaan', 'Anggota Perusahaan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Anggota_Perusahaan', null, ['class' => 'form-control', 'placeholder' => 'Anggota Perusahaan','required']) !!}
      </div>
    {!! $errors->first('Anggota_Perusahaan', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Daya_Tarik_Traction') ? ' has-error' : '' }}">
     {!! Form::label('Daya_Tarik_Traction', 'Daya Tarik atau Traksi',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Daya_Tarik_Traction', null, ['class' => 'form-control', 'placeholder' => 'Daya Tarik atau Traksi','required']) !!}
      </div>
    {!! $errors->first('Daya_Tarik_Traction', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Elevator_Pitch') ? ' has-error' : '' }}">
     {!! Form::label('Elevator_Pitch', 'Elevator Pitch',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Elevator_Pitch', null, ['class' => 'form-control', 'placeholder' => 'Elevator Pitch','required']) !!}
      </div>
    {!! $errors->first('Elevator_Pitch', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Presentasi_video') ? ' has-error' : '' }}">
        {!! Form::label('Presentasi_video', 'Presentasi/ Video Perkembangan Karya',['class' => 'col-sm-10 control-label']) !!}
        <div class="col-sm-12">
           {!! Form::text('Presentasi_video', null, ['class' => 'form-control', 'placeholder' => 'Kemungkinan Proposal dapat diselesaikan','required']) !!}
         </div>
       {!! $errors->first('Presentasi_video', '<p class="help-block">:message</p>') !!}
    </div>
    {{-- @include('komentars._dokumen')  --}}
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('laporan_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
