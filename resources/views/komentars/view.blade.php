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
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Penilaian Proposal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => route('komentars.store'), 'method' => 'post']) !!}
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
            {!! Form::close() !!}
            <div class="box-footer">
                    {!! Form::open(['url' => route('komentars.show',$proposal->id), 'method' => 'get']) !!}
                    {!! Form::submit('Lihat Review Sebelumnya', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
    
                <!-- /.box-header -->
                <!-- form start -->
                <center><iframe src ="{{ asset('/proposal/'.$proposal->upload) }}" width="1000px" height="400px"></iframe></center>
        
        

    <!-- /.row -->
@endsection
