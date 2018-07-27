<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('judul') ? ' has-error' : '' }}">
        {!! Form::label('judul', 'Judul') !!}

        {!! Form::text('judul', null, ['class' => 'form-control', 'placeholder' => 'Judul Proposal']) !!}
        {!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
        {!! Form::label('kategori_id', 'Kategori') !!}

        {!! Form::select('kategori_id', App\Kategori::pluck('nama_kategori','id')->all(), null, ['class' => 'form-control js-select2','placeholder'=>'']) !!}
        {!! $errors->first('kategori_id', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('upload') ? ' has-error' : '' }}">
        {!! Form::label('upload', 'Proposal') !!}

        {!! Form::file('upload') !!}
        @if (isset($proposal) && $proposal->upload)
            {{-- <p> {!! Html::image(asset('proposal/'.$proposal->upload), null, ['class' => 'img-rounded img-responsive']) !!} </p> --}}
        @endif
        <p class="help-block">Size file (PDF) maks 10MB</p>
        {!! $errors->first('upload', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
