@extends('layouts.app')

@section('dashboard')
    Profil
    <small>Profil saya</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Profil</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('/img/'. auth()->user()->avatar) }}" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{ auth()->user()->name }}</h3>
              <h5 class="widget-user-desc">{{ auth()->user()->name }}</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Nama Lengkap/Tim <span class="pull-right badge bg-blue">{{ auth()->user()->name }}</span></a></li>
                <li><a href="#">Email <span class="pull-right badge bg-aqua">{{ auth()->user()->email }}</span></a></li>
                <li><a href="#">Login Terakhir <span class="pull-right badge bg-green">{{ auth()->user()->last_login }}</span></a></li>
                {{-- <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li> --}}
              </ul>
            </div>
            <div class="box-footer clearfix">
                    <a href="{{ url('/settings/profile/edit') }}" class="btn btn-info">Ubah</a>
            </div>
    </div>
@endsection
