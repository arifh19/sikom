@extends('layouts.app')

@section('dashboard')
Laporan
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
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Laporan {{$revisi->judul}}</h3>
        </div>
            <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-muted">Judul Laporan</td>
                            <td><strong></strong>{{ $revisi->judul }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kategori</td>
                            <td>{{ $revisi->kategori->nama_kategori }}</td>
                        </tr>
                        @if($revisi->aplikasi!="")
                        <tr>
                                <td class="text-muted">Link Aplikasi</td>
                                <td><a href="{{$revisi->aplikasi}}" target="_blank" rel="nofollow" class="btn btn-info btn-md">Download</a></td>
                        </tr>
                        @endif
                        <tr>
                                <td class="text-muted">Link Video</td>
                                <td><iframe width="560" height="315" src="https://www.youtube.com/embed/{{$revisi->video}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td>
                            </tr>
                        <tr>
                                <td class="text-muted">File Laporan</td>
                                <td><iframe src ="{{ asset('/laporan/'.$revisi->laporan) }}" width="900px" height="400px"></iframe></td>
                        </tr>
                    </table>
                </div>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    @role(!'member')
                    <h3 class="box-title">Laporan</h3>
                    @endrole
                    @role('member')
                <h3 class="box-title">History Status</h3>
                    @endrole
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- <p> --}}
                        {{-- <a class="btn btn-success" href="{{ url('/admin/proposals/create') }}">Tambah</a> --}}
                        {{-- <a class="btn btn-warning" href="{{ url('/admin/export/books') }}">Export</a> --}}
                    {{-- </p> --}}
                    @role('admin')
                    <p><a class="btn btn-success" href="{{ route('laporanz.create') }}">Tambah</a></p>
                    @endrole
                    @role('staff')
                    <p><a class="btn btn-success" href="{{ route('laporans.create') }}">Tambah</a></p>
                    @endrole
                    @role('member')
                    <p><a class="btn btn-info" href="{{ route('laporan.edit',$revisi->id) }}">Revisi</a></p>
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
