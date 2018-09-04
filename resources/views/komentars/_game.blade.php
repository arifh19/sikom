<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('Story') ? ' has-error' : '' }}">
     {!! Form::label('Story', 'Unsur pendidikan dan keterampilan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Story', null, ['class' => 'form-control', 'placeholder' => 'Unsur pendidikan dan keterampilan','required']) !!}
      </div>
    {!! $errors->first('Story', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Mechanics') ? ' has-error' : '' }}">
     {!! Form::label('Mechanics', 'Kreativitas dalam pengembangan permainan',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Mechanics', null, ['class' => 'form-control', 'placeholder' => 'Kreativitas dalam pengembangan permainan','required']) !!}
      </div>
    {!! $errors->first('Mechanics', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Aesthetics') ? ' has-error' : '' }}">
     {!! Form::label('Aesthetics', 'Unsur Aesthetics',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Aesthetics', null, ['class' => 'form-control', 'placeholder' => 'Unsur Aesthetics','required']) !!}
      </div>
    {!! $errors->first('Aesthetics', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('Gameplay') ? ' has-error' : '' }}">
     {!! Form::label('Gameplay', 'Gameplay menarik dan menghibur',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('Gameplay', null, ['class' => 'form-control', 'placeholder' => 'Gameplay menarik dan menghibur','required']) !!}
      </div>
    {!! $errors->first('Gameplay', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('kesesuaian_proposal') ? ' has-error' : '' }}">
     {!! Form::label('kesesuaian_proposal', 'Kesesuaian Fitur/Fungsi dengan Proposal',['class' => 'col-sm-10 control-label']) !!}
     <div class="col-sm-12">
        {!! Form::text('kesesuaian_proposal', null, ['class' => 'form-control', 'placeholder' => 'Kesesuaian Fitur/Fungsi dengan Proposal','required']) !!}
      </div>
    {!! $errors->first('kesesuaian_proposal', '<p class="help-block">:message</p>') !!}
    </div>
    @include('komentars._dokumen') 
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    {!! Form::text('proposal_id', $proposal->id,['class' => 'col-sm-2 control-label','hidden'=>true]) !!}
</div>
