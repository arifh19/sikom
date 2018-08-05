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

    <div class="row">
        <div class="col-md-6">
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
