@extends('layouts.app')

@section('dashboard')
Proposal
    <small>Tambah Proposal</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ url('/admin/proposals') }}">Proposal</a></li>
    <li class="active">Tambah Proposal</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Isi Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => route('proposals.store'), 'method' => 'post', 'files' => 'true']) !!}
                    @include('proposals._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col (left) -->

        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Buku Panduan V.1</h3>
                </div>
                <center><iframe src ="{{ asset('/info/Buku_Panduan_GEMASTIK-11_Versi_2-0.pdf') }}" width="600px" height="400px"></iframe></center>
            </div>
        </div> 
        <!-- /.col (right)-->
    </div>
    <!-- /.row -->
@endsection
