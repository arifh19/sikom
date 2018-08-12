@extends('layouts.app')

@section('dashboard')
    Informasi Tim
   <small>Informasi Tim</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="{{ url('/mahasiswa/teams') }}">Team</a></li>
   <li class="active">Input Informasi Tim</li>
@endsection

@section('content')
    <div class="row">
        @role('admin')
        {!! Form::open(['url' => route('teamz.store'), 'method' => 'post', 'files' => 'true']) !!}
        @endrole
        @role('staff')
        {!! Form::open(['url' => route('teams.store'), 'method' => 'post', 'files' => 'true']) !!}
        @endrole
        @role('member')
        {!! Form::open(['url' => route('team.store'), 'method' => 'post', 'files' => 'true']) !!}
        @endrole
        <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ketua Tim</h3>
                    </div>
                    @include('teams._ketua')
                </div>
                <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Anggota 1</h3>
                        </div>
                        @include('teams._anggota1')
                </div>
            </div>
        <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Anggota 2</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('teams._anggota2')
                </div>
                <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dosen Pembimbing Tim</h3>
                        </div>
                        <!-- /.box-header -->
                        @include('teams._dosen')
                </div>
                <!-- /.box -->
        </div>
        {!! Form::close() !!}
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
