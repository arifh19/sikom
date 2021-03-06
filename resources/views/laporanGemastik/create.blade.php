@extends('layouts.app')

@section('dashboard')
Proposal
    <small>Tambah Laporan</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    @role('admin')
    <li><a href="{{ url('/admin/laporanz') }}">Proposal</a></li>
    @endrole
    @role('staff')
    <li><a href="{{ url('/staff/laporans') }}">Proposal</a></li>
    @endrole
    @role('member')
    <li><a href="{{ url('/mahasiswa/laporan') }}">Proposal</a></li>
    @endrole
    @role('dosen')
    <li><a href="{{ url('/dosen/laporans') }}">Proposal</a></li>
    @endrole
    <li class="active">Tambah Laporan</li>
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
                @role('admin')
                {!! Form::open(['url' => route('proposalz.store'), 'method' => 'post', 'files' => 'true']) !!}
                @endrole
                @role('staff')
                {!! Form::open(['url' => route('proposals.store'), 'method' => 'post', 'files' => 'true']) !!}
                @endrole
                @role('member')
                {!! Form::open(['url' => route('laporan.store'), 'method' => 'post', 'files' => 'true']) !!}
                @endrole
                    @include('laporanGemastik._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col (left) -->

        <div class="col-md-7">
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Buku Panduan v.2.11</h3>
                </div>
                <center><iframe src ="{{ asset('/info/panduan2.pdf') }}" width="600px" height="400px"></iframe></center>
            </div>
        </div> 
        <!-- /.col (right)-->
    </div>
    <!-- /.row -->

@endsection
