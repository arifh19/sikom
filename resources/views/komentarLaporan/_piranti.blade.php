<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Hasil_kemajuan') ? ' has-error' : '' }}">
        {!! Form::label('Hasil_kemajuan', 'Hasil kemajuan',['class' => 'col-sm-10 control-label']) !!}
        <div class="col-sm-12">
           {!! Form::text('Hasil_kemajuan', null, ['class' => 'form-control', 'placeholder' => 'Hasil kemajuan','required']) !!}
         </div>
       {!! $errors->first('Hasil_kemajuan', '<p class="help-block">:message</p>') !!}
       </div>
    <div class="form-group has-feedback{{ $errors->has('Aspek_kreativitas') ? ' has-error' : '' }}">
     {!! Form::label('Aspek_kreativitas', 'Aspek kreativitas',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Aspek_kreativitas', null, ['class' => 'form-control', 'placeholder' => 'Aspek kreativitas','required']) !!}
      </div>
    {!! $errors->first('Aspek_kreativitas', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Laporan_kemajuan_proposal') ? ' has-error' : '' }}">
     {!! Form::label('Laporan_kemajuan_proposal', 'Laporan Kemajuan atas Proposal',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Laporan_kemajuan_proposal', null, ['class' => 'form-control', 'placeholder' => 'Laporan Kemajuan atas Proposal','required']) !!}
      </div>
    {!! $errors->first('Laporan_kemajuan_proposal', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Potensi_Kegunaan_Hasil_Bagi_Masyarakat') ? ' has-error' : '' }}">
     {!! Form::label('Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'Potensi Kegunaan Hasil Bagi Masyarakat',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Potensi_Kegunaan_Hasil_Bagi_Masyarakat', null, ['class' => 'form-control', 'placeholder' => 'Potensi Kegunaan Hasil bagi Masyarakat','required']) !!}
      </div>
    {!! $errors->first('Potensi_Kegunaan_Hasil_Bagi_Masyarakat', '<p class="help-block">:message</p>') !!}
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
