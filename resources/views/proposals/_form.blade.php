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
        {!! Form::label('judul', 'Judul') !!}

        {!! Form::text('judul', null, ['class' => 'form-control', 'placeholder' => 'Judul Proposal','required']) !!}
        {!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
        {!! Form::label('kategori_id', 'Kategori') !!}

        {!! Form::select('kategori_id', App\Kategori::pluck('nama_kategori','id')->all(), null, ['class' => 'form-control js-select2','placeholder'=>'','required']) !!}
        {!! $errors->first('kategori_id', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('upload') ? ' has-error' : '' }}">
        {!! Form::label('upload', 'Proposal') !!}

        {!! Form::file('upload',['class' => 'form-control','required']) !!}
        <p class="help-block">Size file (PDF) maks 2MB</p>
        {!! $errors->first('upload', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
