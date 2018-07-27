@extends('layouts.app')

@section('dashboard')
   Proposal
   <small>Review Proposal</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="{{ url('/admin/proposals') }}">Proposal</a></li>
   <li class="active">Review Proposal</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">View Proposal</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::model($proposal) !!}
                    @include('proposals._view')
                {!! Form::close() !!}
                    
            </div>
            <!-- /.box -->
      
        <!-- /.col -->
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Upload</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => route('komentars.store'), 'method' => 'post']) !!}
                @include('proposals._formkom')
            {!! Form::close() !!}
        </div>
    </div>
            
                <!-- /.box-header -->
                <!-- form start -->
                <center><iframe src ="{{ asset('/proposal/'.$proposal->upload) }}" width="1000px" height="400px"></iframe></center>
        
        

    <!-- /.row -->
@endsection
