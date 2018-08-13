@extends('layouts.app')

@section('dashboard')
   Proposal
   <small>Ubah Proposal</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    @role('admin')
    <li><a href="{{ url('/admin/proposalz') }}">Proposal</a></li>
    @endrole
    @role('staff')
    <li><a href="{{ url('/staff/proposals') }}">Proposal</a></li>
    @endrole
    @role('member')
    <li><a href="{{ url('/mahasiswa/proposal') }}">Proposal</a></li>
    @endrole
    @role('dosen')
    <li><a href="{{ url('/dosen/proposals') }}">Proposal</a></li>
    @endrole
   <li class="active">Ubah Proposal</li>
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
                    <h3 class="box-title">Ubah Proposal</h3>
                </div>
                <!-- /.box-header -->
                @role('admin')
                {!! Form::model($proposal, ['url' => route('proposalz.update', $proposal->id), 'method' => 'put', 'files' => 'true']) !!}
                @endrole
                @role('staff')
                {!! Form::model($proposal, ['url' => route('proposals.update', $proposal->id), 'method' => 'put', 'files' => 'true']) !!}
                @endrole
                @role('member')
                {!! Form::model($proposal, ['url' => route('proposal.update', $proposal->id), 'method' => 'put', 'files' => 'true']) !!}
                @endrole
                @include('proposals._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Penilaian Proposal</h3>
                    </div>
                    <!-- /.box-header -->
                    {!! Form::model($proposal) !!}
                        @if ($proposal->kategori_id==1)
                            <td><img src="{{ asset('/info/animasi.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($proposal->kategori_id==2)
                            <td><img src="{{ asset('/info/desainux.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($proposal->kategori_id==5)
                            <td><img src="{{ asset('/info/datamining.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($proposal->kategori_id==6)
                            <td><img src="{{ asset('/info/game.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>      
                        @elseif($proposal->kategori_id==7)
                            <td><img src="{{ asset('/info/ppl.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($proposal->kategori_id==8)
                            <td><img src="{{ asset('/info/bisnis.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($proposal->kategori_id==9)
                            <td><img src="{{ asset('/info/piranti.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($proposal->kategori_id==10)
                            <td><img src="{{ asset('/info/smart.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @elseif($proposal->kategori_id==11)
                            <td><img src="{{ asset('/info/kti.jpg') }}" class="img-rounded img-responsive" alt="User Image"></td>
                        @else
                            {{route('proposals.index')}}
                        @endif
                        {!! Form::close() !!}
                        
                </div>
                <!-- /.box -->
          
            <!-- /.col -->
        </div>
    </div>
      
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
