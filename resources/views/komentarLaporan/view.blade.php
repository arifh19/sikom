@extends('layouts.app')

@section('dashboard')
Laporan
   <small>Review Laporan</small>
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
                            <td class="text-muted">Nama Tim</td>
                            <td><strong></strong>{{ $revisi->user->name }}</td>
                        </tr>
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
                                <td>{{$revisi->aplikasi}}</td>
                        </tr>
                        @else
                        <tr>
                                <td class="text-muted">Link Aplikasi</td>
                                <td>-</td>
                        </tr>
                        @endif
                        @if($revisi->video!="")
                        <tr>
                                <td class="text-muted">Link Video</td>
                                <td><iframe width="560" height="315" src="https://www.youtube.com/embed/{{$revisi->video}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td>
                            </tr>
                        <tr>
                        @else
                        <tr>
                                <td class="text-muted">Link Video</td>
                                <td>-</td>
                            </tr>
                        <tr>
                        @endif
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
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                        <p><a class="btn btn-info" target="_blank" rel="nofollow" href="{{ route('dosen.proposals.show',$proposallama->id) }}">Lihat Proposal Sebelumnya</a></p>
                    <h3 class="box-title">View Proposal</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::model($revisi) !!}
                    @if ($revisi->kategori_id==1)
                        <td><img src="{{ asset('/info/animasi.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @elseif($revisi->kategori_id==2)
                        <td><img src="{{ asset('/info/desainux.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @elseif($revisi->kategori_id==5)
                        <td><img src="{{ asset('/info/datamining.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @elseif($revisi->kategori_id==6)
                        <td><img src="{{ asset('/info/game.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>      
                    @elseif($revisi->kategori_id==7)
                        <td><img src="{{ asset('/info/ppl.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @elseif($revisi->kategori_id==8)
                        <td><img src="{{ asset('/info/bisnis2.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @elseif($revisi->kategori_id==9)
                        <td><img src="{{ asset('/info/piranti2.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @elseif($revisi->kategori_id==10)
                        <td><img src="{{ asset('/info/smart.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @elseif($revisi->kategori_id==11)
                        <td><img src="{{ asset('/info/kti.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                    @else
                        {{route('proposals.index')}}
                    @endif
        
                    {!! Form::close() !!}
                    
            </div>
            <!-- /.box -->
      
        <!-- /.col -->
    </div>
    
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Penilaian Proposal</h3>
            </div>
            <p class="help-block col-sm-12">*Untuk rubrik penilaian dapat dilakukan dengan memberikan komentar kritik/saran berupa tulisan maupun penilaian angka</p>
            <!-- /.box-header -->
            <!-- form start -->
            @role('admin')
            {!! Form::open(['url' => route('komentarlaporans.store'), 'method' => 'post','files' => 'true']) !!}
            @endrole
            @role('dosen')
            {!! Form::open(['url' => route('komentarlaporans.store'), 'method' => 'post','files' => 'true']) !!}
            @endrole
            {{-- @role('admin')
                @if ($proposal->kategori_id==1)
                    @include('komentars._animasi')
                @elseif($proposal->kategori_id==2)
                    @include('komentars._desainux')
                @elseif($proposal->kategori_id==5)
                    @include('komentars._datamining')
                @elseif($proposal->kategori_id==6)
                    @include('komentars._game')        
                @elseif($proposal->kategori_id==7)
                    @include('komentars._ppl')   
                @elseif($proposal->kategori_id==8)
                    @include('komentars._bisnis')  
                @elseif($proposal->kategori_id==9)
                    @include('komentars._piranti')  
                @elseif($proposal->kategori_id==10)
                    @include('komentars._smart')  
                @elseif($proposal->kategori_id==11)
                    @include('komentars._kti')  
                @else
                    {{route('proposals.index')}}
                @endif
            @endrole --}}
            @role('dosen')
                @if ($revisi->kategori_id==1)
                    @include('komentarLaporan._animasi')
                @elseif($revisi->kategori_id==2)
                    @include('komentarLaporan._desainux')
                @elseif($revisi->kategori_id==5)
                    @include('komentarLaporan._datamining')
                @elseif($revisi->kategori_id==6)
                    @include('komentarLaporan._game')        
                @elseif($revisi->kategori_id==7)
                    @include('komentarLaporan._ppl')   
                @elseif($revisi->kategori_id==8)
                    @include('komentarLaporan._bisnis')  
                @elseif($revisi->kategori_id==9)
                    @include('komentarLaporan._piranti')  
                @elseif($revisi->kategori_id==10)
                    @include('komentarLaporan._smart')  
                @elseif($revisi->kategori_id==11)
                    @include('komentarLaporan._kti')  
                @else
                    {{route('dosen.laporans.index')}}
                @endif
            @endrole
            {!! Form::close() !!}
            @role('admin')
                {!! Form::open(['url' => route('riwayatproposalz.store'), 'method' => 'post']) !!}
                    @include('komentars._keterangan')  
                {!! Form::close() !!}
            @endrole
            @role('staff')
                {!! Form::open(['url' => route('riwayatproposals.store'), 'method' => 'post']) !!}
                    @include('komentars._keterangan')  
                {!! Form::close() !!}
            @endrole
            <div class="box-footer">
                    @role('admin')
                    <a href="{{route('komentarz.show',$revisi->id)}}" class="btn btn-success btn-md">Lihat Review Dosen</a>           
                    <a href="{{route('riwayatproposalz.show',$revisi->id)}}" class="btn btn-warning btn-md">Lihat Review Staff</a> 
                    @endrole
                    @role('staff')
                    <a href="{{route('komentar.show',$revisi->id)}}" class="btn btn-success btn-md">Lihat Review Dosen</a>           
                    <a href="{{route('riwayatproposals.show',$revisi->id)}}" class="btn btn-warning btn-md">Lihat Review Staff</a> 
                    @endrole
                    {{-- @role('dosen')
                    {!! Form::open(['url' => route('komentars.show',$revisi->id), 'method' => 'get']) !!}
                    {!! Form::submit('Lihat Review Sebelumnya', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                    @endrole   --}}
                   
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
@endsection
