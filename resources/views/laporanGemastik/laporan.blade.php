@extends('layouts.app')

@section('dashboard')
   Proposal
   <small>Daftar Laporan</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Laporan</li>
@endsection

@section('content')
    @if(session()->has('status'))
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Informasi </strong> {{ session('status') }}.
        </div>
    @endif 
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    @role(!'member')
                    <h3 class="box-title">Laporan</h3>
                    @endrole
                    @role('member')
                <h3 class="box-title">Proposal Kategori {{$revisi->kategori->nama_kategori}}</h3>
                    @endrole
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- <p> --}}
                        {{-- <a class="btn btn-success" href="{{ url('/admin/proposals/create') }}">Tambah</a> --}}
                        {{-- <a class="btn btn-warning" href="{{ url('/admin/export/books') }}">Export</a> --}}
                    {{-- </p> --}}
                    @role('admin')
                    <p><a class="btn btn-success" href="{{ route('proposalz.create') }}">Tambah</a></p>
                    @endrole
                    @role('staff')
                    <p><a class="btn btn-success" href="{{ route('proposals.create') }}">Tambah</a></p>
                    @endrole
                    @role('member')
                    <p><a class="btn btn-info" href="{{ route('proposal.edit',$revisi->id) }}">Revisi</a></p>
                    @endrole
                    {!! $html->table(['class' => 'table w3-responsive w3-table-all']) !!}
                    
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    {!! $html->scripts() !!}
@endsection
