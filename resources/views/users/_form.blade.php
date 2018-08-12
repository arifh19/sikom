<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama Tim','required']) !!}
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email','required']) !!}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password','required']) !!}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password Confirmation','required']) !!}
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('avatar') ? ' has-error' : '' }}">
        {!! Form::file('avatar', ['class' => 'form-control']) !!}
        <p class="help-block">(Opsional) Pilih Foto Profil (JPG/JPEG/PNG)</p>
        @if (isset($user) && $user->avatar)
        <p> {!! Html::image(asset('img/'.$user->avatar), null, ['class' => 'img-rounded img-responsive']) !!} </p>
    @endif
        {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
