@extends('layouts.app')

@section('dashboard')
    Dashboard
    <small>Admin</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <!-- Welcome -->
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-success">
              <h4>Selamat Datang di SIKOMATIK</h4>
              <p>Sistem Informasi Manajemen Proposal Komunitas Mahasiswa TIK</p>
            </div>
                <center><h4>STATISTIK PENDAFTAR GEMASTIK 11 KONTINGEN UGM</h4></center><br>    
        </div>
        
    </div>
    

    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-play-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Animasi</span>
                    <span class="info-box-number">{{ $animasi->count() }}<small> </small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-chalkboard-teacher"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Desain Pengalaman</span>
                    <span class="info-box-text">Pengguna</span>
                    <span class="info-box-number">{{ $ux->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fas fa-lock"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Keamanan Jaringan</span>
                    <span class="info-box-text">dan Sistem Informasi</span>
                    <span class="info-box-number">{{ $kjsi->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-laptop-code"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pemrograman</span>
                    <span class="info-box-number">{{ $cp->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fas fa-chart-line"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Data Mining</span>
                    <span class="info-box-number">{{ $datmin->count() }}<small> </small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-gamepad"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pengembangan</span>
                    <span class="info-box-text">Aplikasi Permainan</span>
                    <span class="info-box-number">{{ $gamedev->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-briefcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pengembangan Bisnis</span>
                    <span class="info-box-text">TIK</span>
                    <span class="info-box-number">{{ $bistik->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-qrcode"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pengembangan</span>
                    <span class="info-box-text">Perangkat Lunak</span>
                    <span class="info-box-number">{{ $ppl->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-microchip"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Piranti Cerdas</span>
                    <span class="info-box-number">{{ $piranti->count() }}<small> </small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fas fa-building"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Smart City</span>
                    <span class="info-box-number">{{ $smartcity->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fas fa-edit"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Karya Tulis</span>
                    <span class="info-box-text">Ilmiah TIK</span>
                    <span class="info-box-number">{{ $kti->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection
