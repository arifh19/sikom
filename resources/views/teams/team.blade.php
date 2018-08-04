@extends('layouts.app')

@section('dashboard')
    Team
    <small>Informasi Tim</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Team</li>
@endsection

@section('content')
    <div class="box-footer clearfix">
        <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-info">Ubah</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ketua Tim</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-muted">Nama Ketua</td>
                            <td>{{ $team->nama_ketua }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIM Ketua</td>
                            <td>{{ $team->nim_ketua }}</td>
                        </tr>
                        <tr>
                                <td class="text-muted">FKJA</td>
                                <td>{{ $team->fkja_ketua }}</td>
                        </tr>
                        <tr>
                                <td class="text-muted">No HP Ketua</td>
                                <td>{{ $team->no_hp_ketua }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">KTM Ketua</td>
                            <td><img src="{{ asset('/teams/'. $team->foto_ktm_ketua) }}" class="img-rounded img-responsive" alt="User Image"></td>
                        </tr>
                    </table>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Anggota 1</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
        
                        <tr>
                            <td class="text-muted">Nama Anggota 1</td>
                            <td>{{ $team->nama_anggota1 }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIM Anggota 1</td>
                            <td>{{ $team->nim_anggota1 }}</td>
                        </tr>
                        <tr>
                                <td class="text-muted">FKJA</td>
                                <td>{{ $team->fkja_anggota1 }}</td>
                        </tr>
                        <tr>
                                <td class="text-muted">No HP Anggota 1</td>
                                <td>{{ $team->no_hp_anggota1 }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">KTM Anggota 1</td>
                            <td><img src="{{ asset('/teams/'. $team->foto_ktm_anggota1) }}" class="img-rounded img-responsive" alt="User Image"></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Anggota 2</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-muted">Nama Anggota 2</td>
                                <td>{{ $team->nama_anggota2 }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">NIM Anggota 2</td>
                                <td>{{ $team->nim_anggota2 }}</td>
                            </tr>
                            <tr>
                                    <td class="text-muted">FKJA</td>
                                    <td>{{ $team->fkja_anggota2 }}</td>
                            </tr>
                            <tr>
                                    <td class="text-muted">No HP Anggota 2</td>
                                    <td>{{ $team->no_hp_anggota2 }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">KTM Anggota 2</td>
                                <td><img src="{{ asset('/teams/'. $team->foto_ktm_anggota2) }}" class="img-rounded img-responsive" alt="User Image"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Dosen Pembimbing Tim</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
            
                            <tr>
                                <td class="text-muted">Nama Dosen</td>
                                <td>{{ $team->nama_dosbing }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">NIDN</td>
                                <td>{{ $team->nidn }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
