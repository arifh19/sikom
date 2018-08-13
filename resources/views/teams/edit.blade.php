@extends('layouts.app')

@section('dashboard')
    Profile
    <small>Edit Profile</small>
@endsection

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    @role('admin')
    <li><a href="{{ url('/admin/teamz') }}">Team</a></li>
    @endrole
    @role('staff')
    <li><a href="{{ url('/staff/teams') }}">Team</a></li>
    @endrole
    @role('member')
    <li><a href="{{ url('/mahasiswa/team') }}">Team</a></li>
    @endrole
    @role('dosen')
    <li><a href="{{ url('/dosen/teams') }}">Team</a></li>
    @endrole
    <li class="active">Edit Profile</li>
@endsection

@section('content')
    <div class="row">
            
    @role('admin')
    {!! Form::model($team, ['url' => route('teamz.update', $team->id), 'method' => 'put', 'files' => 'true']) !!}
    @endrole
    @role('staff')
    {!! Form::model($team, ['url' => route('teams.update', $team->id), 'method' => 'put', 'files' => 'true']) !!}
    @endrole
    @role('member')
    {!! Form::model($team, ['url' => route('team.update', $team->id), 'method' => 'put', 'files' => 'true']) !!}
    @endrole
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ketua Tim</h3>
                </div>
                @include('teams._editketua')
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
