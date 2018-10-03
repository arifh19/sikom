<div class="box-body">
    @role('admin')
    <div class="form-group has-feedback{{ $errors->has('user_id') ? ' has-error' : '' }}">
        {!! Form::label('user_id', 'Nama Tim') !!}

        {!! Form::select('user_id', App\User::pluck('name','id')->all(), null, ['class' => 'form-control js-select2','placeholder'=>'','required']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
    @endrole
    @role('staff')
    <div class="form-group has-feedback{{ $errors->has('user_id') ? ' has-error' : '' }}">
        {!! Form::label('user_id', 'Nama Tim') !!}

        {!! Form::select('user_id', App\User::pluck('name','id')->all(), null, ['class' => 'form-control js-select2','placeholder'=>'','required']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
    @endrole
    <div class="form-group has-feedback{{ $errors->has('judul') ? ' has-error' : '' }}">
        {!! Form::label('judul', 'Judul Laporan') !!}

        {!! Form::text('judul', null, ['class' => 'form-control', 'placeholder' => 'Judul Laporan','required']) !!}
        {!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
        {!! Form::label('kategori_id', 'Kategori') !!}

        {!! Form::select('kategori_id', App\Kategori::pluck('nama_kategori','id')->all(), null, ['class' => 'form-control js-select2','placeholder'=>'','required']) !!}
        {!! $errors->first('kategori_id', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('laporan') ? ' has-error' : '' }}">
        {!! Form::label('laporan', 'Laporan') !!}

        {!! Form::file('laporan',['class' => 'form-control']) !!}
        <p class="help-block">Size file (PDF) maks 2MB</p>
        {!! $errors->first('laporan', '<p class="help-block">:message</p>') !!}
    </div>
    

    <div class="form-group has-feedback{{ $errors->has('video') ? ' has-error' : '' }}">
        {!! Form::label('video', 'Link Video') !!}

        {!! Form::text('video', null, ['class' => 'form-control', 'placeholder' => 'Link Video']) !!}
        {!! $errors->first('video', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('aplikasi') ? ' has-error' : '' }}">
        {!! Form::label('aplikasi', 'Link Aplikasi') !!}

        {!! Form::text('aplikasi', null, ['class' => 'form-control', 'placeholder' => 'Link aplikasi']) !!}
        {!! $errors->first('aplikasi', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
