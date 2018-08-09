<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('nama_ketua') ? ' has-error' : '' }}">
        {!! Form::label('nama_ketua', 'Nama Ketua') !!}
        {!! Form::text('nama_ketua', null, ['class' => 'form-control', 'placeholder' => 'Nama Ketua Tim','required']) !!}
        {!! $errors->first('nama_ketua', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('nim_ketua') ? ' has-error' : '' }}">
        {!! Form::label('nim_ketua', 'NIM Ketua Tim') !!}
        {!! Form::text('nim_ketua', null, ['class' => 'form-control', 'placeholder' => 'NIM Ketua Tim','required']) !!}
        {!! $errors->first('nim_ketua', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('fkja_ketua') ? ' has-error' : '' }}">
        {!! Form::label('fkja_ketua', 'Fakultas-Prodi-Angkatan') !!}
        {!! Form::text('fkja_ketua', null, ['class' => 'form-control', 'placeholder' => 'Fakultas-Prodi-Angkatan','required']) !!}
        {!! $errors->first('fkja_ketua', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('no_hp_ketua') ? ' has-error' : '' }}">
        {!! Form::label('no_hp_ketua', 'No HP Ketua') !!}
        {!! Form::text('no_hp_ketua', null, ['class' => 'form-control', 'placeholder' => 'No HP Ketua','required']) !!}
        {!! $errors->first('no_hp_ketua', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('foto_ktm_ketua') ? ' has-error' : '' }}">
        {!! Form::label('foto_ktm_ketua', 'Foto KTM Ketua Tim') !!}

        {!! Form::file('foto_ktm_ketua',['class' => 'form-control','required']) !!}
        @if (isset($team) && $team->foto_ktm_ketua)
            {{-- <p> {!! Html::image(asset('proposal/'.$proposal->upload), null, ['class' => 'img-rounded img-responsive']) !!} </p> --}}
        @endif
        <p class="help-block">Size file (JPG/PNG/JPEG) maks 2MB</p>
        {!! $errors->first('foto_ktm_ketua', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->
