<div class="col-sm-10">
    <div class="form-group has-feedback{{ $errors->has('lampiran') ? ' has-error' : '' }}">
            <br>
            {!! Form::label('lampiran', 'Lampiran(Lampirkan file apabila diperlukan pdf/docx) *tidak wajib/boleh dikosongi') !!}
            {!! Form::file('lampiran',['class' => 'form-control']) !!}
            <p class="help-block">Size file (docx/pdf) maks 10MB</p>
            {!! $errors->first('lampiran', '<p class="help-block">:message</p>') !!}
    </div>
</div>