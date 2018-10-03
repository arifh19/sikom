@extends('layouts.app')

@section('dashboard')
   Proposal
   <small>Ubah Laporan</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    @role('admin')
    <li><a href="{{ url('/admin/laporanz') }}">Laporan</a></li>
    @endrole
    @role('staff')
    <li><a href="{{ url('/staff/laporans') }}">Laporan</a></li>
    @endrole
    @role('member')
    <li><a href="{{ url('/mahasiswa/laporan') }}">Laporan</a></li>
    @endrole
    @role('dosen')
    <li><a href="{{ url('/dosen/laporans') }}">Laporan</a></li>
    @endrole
   <li class="active">Ubah Laporan</li>
@endsection

@section('content')
    @if(session()->has('status'))
        <div class="alert alert-info fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Sukses </strong> {{ session('status') }}.
        </div>
    @endif 
    @if(session()->has('warning'))
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Gagal </strong> {{ session('warning') }}.
        </div>
    @endif 
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Laporan</h3>
                </div>
                <!-- /.box-header -->
                @role('admin')
                {!! Form::model($laporan, ['url' => route('laporanz.update', $laporan->id), 'method' => 'put', 'files' => 'true']) !!}
                @endrole
                @role('staff')
                {!! Form::model($laporan, ['url' => route('laporans.update', $laporan->id), 'method' => 'put', 'files' => 'true']) !!}
                @endrole
                @role('member')
                {!! Form::model($laporan, ['url' => route('laporan.update', $laporan->id), 'method' => 'put', 'files' => 'true']) !!}
                @endrole
                @include('laporanGemastik._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Penilaian Laporan</h3>
                    </div>
                    <!-- /.box-header -->
                    {!! Form::model($laporan) !!}
                        @if ($laporan->kategori_id==1)
                            <td><img src="{{ asset('/info/animasi.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($laporan->kategori_id==2)
                            <td><img src="{{ asset('/info/desainux.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($laporan->kategori_id==5)
                            <td><img src="{{ asset('/info/datamining.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($laporan->kategori_id==6)
                            <td><img src="{{ asset('/info/game.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>      
                        @elseif($laporan->kategori_id==7)
                            <td><img src="{{ asset('/info/ppl.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($laporan->kategori_id==8)
                            <td><img src="{{ asset('/info/bisnis.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($laporan->kategori_id==9)
                            <td><img src="{{ asset('/info/piranti.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($laporan->kategori_id==10)
                            <td><img src="{{ asset('/info/smart.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($laporan->kategori_id==11)
                            <td><img src="{{ asset('/info/kti.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @else
                            {{route('laporans.index')}}
                        @endif
                        {!! Form::close() !!}
                        
                </div>
                <!-- /.box -->
          
            <!-- /.col -->
        </div>
    </div>
      
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <center><iframe src ="{{ asset('/laporan/'.$laporan->laporan) }}" width="1000px" height="400px"></iframe></center>
            </div>
       

    <!-- /.row -->
@endsection
