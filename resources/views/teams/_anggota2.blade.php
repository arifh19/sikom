<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('nama_anggota2') ? ' has-error' : '' }}">
        {!! Form::label('nama_anggota2', 'Nama Anggota 2') !!}
        {!! Form::text('nama_anggota2', null, ['class' => 'form-control', 'placeholder' => 'Nama Anggota 2']) !!}
        {!! $errors->first('nama_anggota2', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('nim_anggota2') ? ' has-error' : '' }}">
        {!! Form::label('nim_anggota2', 'NIM Anggota 2') !!}
        {!! Form::text('nim_anggota2', null, ['class' => 'form-control', 'placeholder' => 'NIM Anggota 2']) !!}
        {!! $errors->first('nim_anggota2', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('fkja_anggota2') ? ' has-error' : '' }}">
        {!! Form::label('fkja_anggota2', 'Fakultas-Prodi-Angkatan') !!}
        {!! Form::text('fkja_anggota2', null, ['class' => 'form-control', 'placeholder' => 'Fakultas-Prodi-Angkatan']) !!}
        {!! $errors->first('fkja_anggota2', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('no_hp_anggota2') ? ' has-error' : '' }}">
        {!! Form::label('no_hp_anggota2', 'No HP Anggota 2') !!}
        {!! Form::text('no_hp_anggota2', null, ['class' => 'form-control', 'placeholder' => 'No HP Anggota 2']) !!}
        {!! $errors->first('no_hp_anggota2', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('foto_ktm_anggota2') ? ' has-error' : '' }}">
        {!! Form::label('foto_ktm_anggota2', 'Foto KTM Anggota 2') !!}
        {!! Form::file('foto_ktm_anggota2') !!}
        @if (isset($team) && $team->foto_ktm_anggota2)
            {{-- <p> {!! Html::image(asset('proposal/'.$proposal->upload), null, ['class' => 'img-rounded img-responsive']) !!} </p> --}}
        @endif
        <p class="help-block">Size file (JPG/PNG/JPEG) maks 2MB</p>
        {!! $errors->first('foto_ktm_anggota2', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->
