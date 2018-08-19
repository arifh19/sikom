<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Proposal;
use App\Kategori;
use App\Team;
use App\Komentar;
use App\Role;
use App\BorrowLog;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if (Laratrust::hasRole('member')) {
            $cekkategori = Proposal::where('user_id', Auth::user()->id)->first();
            $cekproposal = Proposal::where('user_id', Auth::user()->id);
            if ($request->ajax()) {
                $proposals = Proposal::where('user_id', Auth::user()->id)->first();
                $komentars = Komentar::where('proposal_id', $proposals->id)->with('user');
    
                return Datatables::of($komentars)->orderBy('updated_at','desc')->make(true);
            }
            if($cekproposal->count()==1){
                if($cekkategori->kategori_id==1){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable' => false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable' => false])
                    ->addColumn(['data' => 'Ide_konsep_keaslian', 'name' => 'Ide_konsep_keaslian', 'title' => 'Ide Konsep Keaslian','orderable' => false])
                    ->addColumn(['data' => 'Konsistensi_tema', 'name' => 'Konsistensi_tema', 'title' => 'Konsistensi Tema','orderable' => false])
                    ->addColumn(['data' => 'Kreativitas_dalam_implementasi', 'name' => 'Kreativitas_dalam_implementasi', 'title' => 'Kreativitas dalam implementasi','orderable' => false])
                    ->addColumn(['data' => 'Teknik_modelling_lighting_motion', 'name' => 'Teknik_modelling_lighting_motion', 'title' => 'Teknik (modelling,lighting,motion)','orderable' => false])
                    ->addColumn(['data' => 'Kekuatan_pesan_artistik', 'name' => 'Kekuatan_pesan_artistik', 'title' => 'Kekuatan pesan artistik','orderable' => false]);
                }
                elseif($cekkategori->kategori_id==2){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'Identifikasi_permasalahan', 'name' => 'Identifikasi_permasalahan', 'title' => 'Identifikasi Permasalahan','orderable'=>false])
                    ->addColumn(['data' => 'Inovasi_desain', 'name' => 'Inovasi_desain', 'title' => 'Inovasi Desain','orderable'=>false])
                    ->addColumn(['data' => 'Metode_Desain', 'name' => 'Metode_Desain', 'title' => 'Metode Desain','orderable'=>false])
                   // ->addColumn(['data' => 'Prototype', 'name' => 'Prototype', 'title' => 'Low Fidelity Prototype','orderable'=>false])
                    ->addColumn(['data' => 'Komunikasi', 'name' => 'Komunikasi', 'title' => 'Komunikasi (PPV)','orderable'=>false]);
                }
                elseif($cekkategori->kategori_id==5){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'originalitas', 'name' => 'originalitas', 'title' => 'Originalitas','orderable'=>false])
                    ->addColumn(['data' => 'kebaruan', 'name' => 'kebaruan', 'title' => 'Kebaruan','orderable'=>false])
                    ->addColumn(['data' => 'manfaat', 'name' => 'manfaat', 'title' => 'Manfaat','orderable'=>false])
                    ->addColumn(['data' => 'clarity', 'name' => 'clarity', 'title' => 'Clarity dalam tulisan','orderable'=>false])                
                    ->addColumn(['data' => 'kelengkapan_laporan', 'name' => 'kelengkapan_laporan', 'title' => 'Kelengkapan Laporan','orderable'=>false]);
                }
                elseif($cekkategori->kategori_id==6){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'Story', 'name' => 'Story', 'title' => 'Unsur pendidikan dan keterampilan','orderable'=>false])
                    ->addColumn(['data' => 'Mechanics', 'name' => 'Mechanics', 'title' => 'Kreativitas dalam pengembangan permainan','orderable'=>false])
                    ->addColumn(['data' => 'Aesthetics', 'name' => 'Aesthetics', 'title' => 'Unsur Aesthetics','orderable'=>false])
                    ->addColumn(['data' => 'Gameplay', 'name' => 'Gameplay', 'title' => 'Gameplay menarik dan menghibur','orderable'=>false])
                    ->addColumn(['data' => 'kesesuaian_proposal', 'name' => 'kesesuaian_proposal', 'title' => 'Kesesuaian fitur dengan Proposal','orderable'=>false]);
                }
                elseif($cekkategori->kategori_id==7){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'Aspek_Inovasi', 'name' => 'Aspek_Inovasi', 'title' => 'Aspek Inovasi','orderable'=>false])
                    ->addColumn(['data' => 'Dampak_pengguna_masyarakat', 'name' => 'Dampak_pengguna_masyarakat', 'title' => 'Dampak penggunaan ke masyarakat','orderable'=>false])
                    ->addColumn(['data' => 'Desain_dan_usability', 'name' => 'Desain_dan_usability', 'title' => 'Desain antarmuka dan usability','orderable'=>false])
                    ->addColumn(['data' => 'metodologi_pengembangan', 'name' => 'metodologi_pengembangan', 'title' => 'Metodologi Pengembangan','orderable'=>false])
                    ->addColumn(['data' => 'Kesesuaian_ide', 'name' => 'Kesesuaian_ide', 'title' => 'Kesesuaian Ide','orderable'=>false])
                    ->addColumn(['data' => 'Urgensi_permasalahan', 'name' => 'Urgensi_permasalahan', 'title' => 'Urgensi Permasalahan','orderable'=>false]);
                }
                elseif($cekkategori->kategori_id==8){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'Penjelasan_Problem_Bisnis', 'name' => 'Penjelasan_Problem_Bisnis', 'title' => 'Penjelasan Problem Bisnis','orderable'=>false])
                    ->addColumn(['data' => 'Produk_Layanan', 'name' => 'Produk_Layanan', 'title' => 'Produk atau Layanan','orderable'=>false])
                    ->addColumn(['data' => 'Pasar_Market', 'name' => 'Pasar_Market', 'title' => 'Pasar/Market','orderable'=>false])
                    ->addColumn(['data' => 'Strategi_Bisnis', 'name' => 'Strategi_Bisnis', 'title' => 'Strategi Bisnis','orderable'=>false])
                    ->addColumn(['data' => 'Anggota_Perusahaan', 'name' => 'Anggota_Perusahaan', 'title' => 'Anggota Perusahaan','orderable'=>false])
                    ->addColumn(['data' => 'Daya_Tarik_Traction', 'name' => 'Daya_Tarik_Traction', 'title' => 'Daya Tarik atau Traksi','orderable'=>false])
                    ->addColumn(['data' => 'Elevator_Pitch', 'name' => 'Elevator_Pitch', 'title' => 'Elevator Pitch','orderable'=>false]);
                }
                elseif($cekkategori->kategori_id==9){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'Aspek_kreativitas', 'name' => 'Aspek_kreativitas', 'title' => 'Aspek kreativitas','orderable'=>false])
                    ->addColumn(['data' => 'Penulisan_proposal', 'name' => 'Penulisan_proposal', 'title' => 'Penulisan proposal','orderable'=>false])
                    ->addColumn(['data' => 'Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'name' => 'Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'title' => 'Potensi Kegunaan Hasil Bagi Masyarakat','orderable'=>false])
                    ->addColumn(['data' => 'Kemungkinan_Proposal_Dapat_Diselesaikan', 'name' => 'Kemungkinan_Proposal_Dapat_Diselesaikan', 'title' => 'Kemungkinan Proposal dapat diselesaikan','orderable'=>false]);
                }
                elseif($cekkategori->kategori_id==10){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'Permasalahan_yang_diangkat', 'name' => 'Permasalahan_yang_diangkat', 'title' => 'Permasalahan yang diangkat','orderable'=>false])
                    ->addColumn(['data' => 'Pemaparan_permasalahan', 'name' => 'Pemaparan_permasalahan', 'title' => 'Pemaparan permasalahan','orderable'=>false])
                    ->addColumn(['data' => 'Dampak_implementasi', 'name' => 'Dampak_implementasi', 'title' => 'Dampak implementasi','orderable'=>false])
                    ->addColumn(['data' => 'Inovasi_pengembangan', 'name' => 'Inovasi_pengembangan', 'title' => 'Inovasi Pengembangan','orderable'=>false]);
                }
                elseif($cekkategori->kategori_id==11){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa','orderable'=>false])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa','orderable'=>false])
                    ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul','orderable'=>false])
                    ->addColumn(['data' => 'abstrak', 'name' => 'abstrak', 'title' => 'Abstrak','orderable'=>false])
                    ->addColumn(['data' => 'pendahuluan', 'name' => 'pendahuluan', 'title' => 'Pendahuluan','orderable'=>false])
                    ->addColumn(['data' => 'tujuan', 'name' => 'tujuan', 'title' => 'Tujuan','orderable'=>false])
                    ->addColumn(['data' => 'metode', 'name' => 'metode', 'title' => 'Metode','orderable'=>false])
                    ->addColumn(['data' => 'hasil_pembahasan', 'name' => 'hasil_pembahasan', 'title' => 'Hasil dan Pembahasan','orderable'=>false])
                    ->addColumn(['data' => 'kesimpulan', 'name' => 'kesimpulan', 'title' => 'Kesimpulan','orderable'=>false])
                    ->addColumn(['data' => 'daftar_pustaka', 'name' => 'daftar_pustaka', 'title' => 'Daftar Pustaka','orderable'=>false]);
                }
                else{
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa']);
                }
            }
            else{
                $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa']);
                return view('dashboard.member', compact('proposals','html'));
            }
            return view('dashboard.member', compact('proposals','html'));
        }

        if (Laratrust::hasRole('admin')) {

            $animasi = Team::where('kategori_id',Kategori::where('nama_kategori','Animasi')->first()->id);
            $ux = Team::where('kategori_id',Kategori::where('nama_kategori','Desain Pengalaman Pengguna(UX)')->first()->id);
            $kjsi = Team::where('kategori_id',Kategori::where('nama_kategori','Keamanan Jaringan dan Sistem Informasi')->first()->id);
            $cp = Team::where('kategori_id',Kategori::where('nama_kategori','Pemrograman')->first()->id);
            $datmin = Team::where('kategori_id',Kategori::where('nama_kategori','Penambangan Data(Data Mining)')->first()->id);
            $gamedev = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Aplikasi Permainan')->first()->id);
            $bistik = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Perangkat Lunak')->first()->id);
            $ppl = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Bisnis TIK')->first()->id);
            $piranti = Team::where('kategori_id',Kategori::where('nama_kategori','Piranti Cerdas, Sistem Benam dan IoT')->first()->id);
            $smartcity = Team::where('kategori_id',Kategori::where('nama_kategori','Kota Cerdas (Smart City)')->first()->id);
            $kti = Team::where('kategori_id',Kategori::where('nama_kategori','Karya Tulis Ilmiah TIK')->first()->id);

            return view('dashboard.admin', compact('animasi', 'ux', 'kjsi', 'cp','datmin','gamedev','bistik','ppl','piranti','smartcity','kti'));
        }

        if (Laratrust::hasRole('dosen')) {

            $animasi = Team::where('kategori_id',Kategori::where('nama_kategori','Animasi')->first()->id);
            $ux = Team::where('kategori_id',Kategori::where('nama_kategori','Desain Pengalaman Pengguna(UX)')->first()->id);
            $kjsi = Team::where('kategori_id',Kategori::where('nama_kategori','Keamanan Jaringan dan Sistem Informasi')->first()->id);
            $cp = Team::where('kategori_id',Kategori::where('nama_kategori','Pemrograman')->first()->id);
            $datmin = Team::where('kategori_id',Kategori::where('nama_kategori','Penambangan Data(Data Mining)')->first()->id);
            $gamedev = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Aplikasi Permainan')->first()->id);
            $bistik = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Perangkat Lunak')->first()->id);
            $ppl = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Bisnis TIK')->first()->id);
            $piranti = Team::where('kategori_id',Kategori::where('nama_kategori','Piranti Cerdas, Sistem Benam dan IoT')->first()->id);
            $smartcity = Team::where('kategori_id',Kategori::where('nama_kategori','Kota Cerdas (Smart City)')->first()->id);
            $kti = Team::where('kategori_id',Kategori::where('nama_kategori','Karya Tulis Ilmiah TIK')->first()->id);

            return view('dashboard.dosen', compact('animasi', 'ux', 'kjsi', 'cp','datmin','gamedev','bistik','ppl','piranti','smartcity','kti'));
        }
        if (Laratrust::hasRole('staff')) {

            $animasi = Team::where('kategori_id',Kategori::where('nama_kategori','Animasi')->first()->id);
            $ux = Team::where('kategori_id',Kategori::where('nama_kategori','Desain Pengalaman Pengguna(UX)')->first()->id);
            $kjsi = Team::where('kategori_id',Kategori::where('nama_kategori','Keamanan Jaringan dan Sistem Informasi')->first()->id);
            $cp = Team::where('kategori_id',Kategori::where('nama_kategori','Pemrograman')->first()->id);
            $datmin = Team::where('kategori_id',Kategori::where('nama_kategori','Penambangan Data(Data Mining)')->first()->id);
            $gamedev = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Aplikasi Permainan')->first()->id);
            $bistik = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Perangkat Lunak')->first()->id);
            $ppl = Team::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Bisnis TIK')->first()->id);
            $piranti = Team::where('kategori_id',Kategori::where('nama_kategori','Piranti Cerdas, Sistem Benam dan IoT')->first()->id);
            $smartcity = Team::where('kategori_id',Kategori::where('nama_kategori','Kota Cerdas (Smart City)')->first()->id);
            $kti = Team::where('kategori_id',Kategori::where('nama_kategori','Karya Tulis Ilmiah TIK')->first()->id);

            return view('dashboard.staff', compact('animasi', 'ux', 'kjsi', 'cp','datmin','gamedev','bistik','ppl','piranti','smartcity','kti'));
        }
        return view('auth.login');
    }
}
