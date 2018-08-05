<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Aspek_kreativitas') ? ' has-error' : '' }}">
     {!! Form::label('Aspek_kreativitas', 'Aspek kreativitas',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Aspek_kreativitas', null, ['class' => 'form-control', 'placeholder' => 'Aspek kreativitas']) !!}
      </div>
    {!! $errors->first('Aspek_kreativitas', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Penulisan_proposal') ? ' has-error' : '' }}">
     {!! Form::label('Penulisan_proposal', 'Penulisan proposal',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Penulisan_proposal', null, ['class' => 'form-control', 'placeholder' => 'Penulisan proposal']) !!}
      </div>
    {!! $errors->first('Penulisan_proposal', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Potensi_Kegunaan_Hasil_Bagi_Masyarakat') ? ' has-error' : '' }}">
     {!! Form::label('Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'Potensi Kegunaan Hasil Bagi Masyarakat',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Potensi_Kegunaan_Hasil_Bagi_Masyarakat', null, ['class' => 'form-control', 'placeholder' => 'Potensi Kegunaan Hasil bagi Masyarakat']) !!}
      </div>
    {!! $errors->first('Potensi_Kegunaan_Hasil_Bagi_Masyarakat', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Kemungkinan_Proposal_Dapat_Diselesaikan') ? ' has-error' : '' }}">
     {!! Form::label('Kemungkinan_Proposal_Dapat_Diselesaikan', 'Kemungkinan Proposal dapat diselesaikan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Kemungkinan_Proposal_Dapat_Diselesaikan', null, ['class' => 'form-control', 'placeholder' => 'Kemungkinan Proposal dapat diselesaikan']) !!}
      </div>
    {!! $errors->first('Kemungkinan_Proposal_Dapat_Diselesaikan', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
