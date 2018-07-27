@extends('layouts.app')

@section('dashboard')
   Proposal
   <small>Ubah Proposal</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="{{ url('/admin/proposals') }}">Proposal</a></li>
   <li class="active">Ubah Proposal</li>
@endsection

@section('content')

        
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Proposal</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::model($proposal, ['url' => route('proposals.update', $proposal->id), 'method' => 'put', 'files' => 'true']) !!}
                    @include('proposals._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
      
        <!-- /.col -->
      
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <center><iframe src ="{{ asset('/proposal/'.$proposal->upload) }}" width="1000px" height="400px"></iframe></center>
            </div>
       

    <!-- /.row -->
@endsection
