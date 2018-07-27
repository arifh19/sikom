@extends('layouts.app')

@section('dashboard')
Kategori
   <small>Ubah Kategori</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="{{ url('/admin/kategoris') }}">Kategori</a></li>
   <li class="active">Ubah Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Kategori</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::model($kategori, ['url' => route('kategoris.update', $kategori->id), 'method' => 'put']) !!}
                    @include('kategoris._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
