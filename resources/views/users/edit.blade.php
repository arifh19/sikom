@extends('layouts.app')

@section('dashboard')
Pengguna
   <small>Ubah Pengguna</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="{{ url('/admin/kategoris') }}">Users</a></li>
   <li class="active">Ubah Pengguna</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Pengguna</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::model($user, ['url' => route('userz.update', $user->id), 'method' => 'put', 'files' => 'true']) !!}
                    @include('users._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
