
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-muted">Nama Tim </td>
                            <td>{{ $team->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Judul </td>
                            <td>{{ $proposal->judul }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kategori</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Input</td>
                            <td>{{ $proposal->updated_at }}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
    <!-- /.row -->
