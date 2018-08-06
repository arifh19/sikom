<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;
use App\Author;
use App\Proposal;
use App\Kategori;
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
    
                return Datatables::of($komentars)->make(true);
            }
            if($cekproposal->count()==1){
                if($cekkategori->kategori_id==1){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'Ide_konsep_keaslian', 'name' => 'Ide_konsep_keaslian', 'title' => 'Ide Konsep Keaslian'])
                    ->addColumn(['data' => 'Konsistensi_tema', 'name' => 'Konsistensi_tema', 'title' => 'Konsistensi Tema'])
                    ->addColumn(['data' => 'Kreativitas_dalam_implementasi', 'name' => 'Kreativitas_dalam_implementasi', 'title' => 'Kreativitas dalam implementasi'])
                    ->addColumn(['data' => 'Teknik_modelling_lighting_motion', 'name' => 'Teknik_modelling_lighting_motion', 'title' => 'Teknik (modelling,lighting,motion)'])
                    ->addColumn(['data' => 'Kekuatan_pesan_artistik', 'name' => 'Kekuatan_pesan_artistik', 'title' => 'Kekuatan pesan artistik']);
                }
                elseif($cekkategori->kategori_id==2){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'Identifikasi_permasalahan', 'name' => 'Identifikasi_permasalahan', 'title' => 'Identifikasi Permasalahan'])
                    ->addColumn(['data' => 'Inovasi_desain', 'name' => 'Inovasi_desain', 'title' => 'Inovasi Desain'])
                    ->addColumn(['data' => 'Metode_Desain', 'name' => 'Metode_Desain', 'title' => 'Metode Desain'])
                   // ->addColumn(['data' => 'Prototype', 'name' => 'Prototype', 'title' => 'Low Fidelity Prototype'])
                    ->addColumn(['data' => 'Komunikasi', 'name' => 'Komunikasi', 'title' => 'Komunikasi (PPV)']);
                }
                elseif($cekkategori->kategori_id==5){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'originalitas', 'name' => 'originalitas', 'title' => 'Originalitas'])
                    ->addColumn(['data' => 'kebaruan', 'name' => 'kebaruan', 'title' => 'Kebaruan'])
                    ->addColumn(['data' => 'manfaat', 'name' => 'manfaat', 'title' => 'Manfaat'])
                    ->addColumn(['data' => 'clarity', 'name' => 'clarity', 'title' => 'Clarity dalam tulisan'])                
                    ->addColumn(['data' => 'kelengkapan_laporan', 'name' => 'kelengkapan_laporan', 'title' => 'Kelengkapan Laporan']);
                }
                elseif($cekkategori->kategori_id==6){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'Story', 'name' => 'Story', 'title' => 'Unsur pendidikan dan keterampilan'])
                    ->addColumn(['data' => 'Mechanics', 'name' => 'Mechanics', 'title' => 'Kreativitas dalam pengembangan permainan'])
                    ->addColumn(['data' => 'Aesthetics', 'name' => 'Aesthetics', 'title' => 'Unsur Aesthetics'])
                    ->addColumn(['data' => 'Gameplay', 'name' => 'Gameplay', 'title' => 'Gameplay menarik dan menghibur'])
                    ->addColumn(['data' => 'kesesuaian_proposal', 'name' => 'kesesuaian_proposal', 'title' => 'Kesesuaian fitur dengan Proposal']);
                }
                elseif($cekkategori->kategori_id==7){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'Aspek_Inovasi', 'name' => 'Aspek_Inovasi', 'title' => 'Aspek Inovasi'])
                    ->addColumn(['data' => 'Dampak_pengguna_masyarakat', 'name' => 'Dampak_pengguna_masyarakat', 'title' => 'Dampak penggunaan ke masyarakat'])
                    ->addColumn(['data' => 'Desain_dan_usability', 'name' => 'Desain_dan_usability', 'title' => 'Desain antarmuka dan usability'])
                    ->addColumn(['data' => 'metodologi_pengembangan', 'name' => 'metodologi_pengembangan', 'title' => 'Metodologi Pengembangan'])
                    ->addColumn(['data' => 'Kesesuaian_ide', 'name' => 'Kesesuaian_ide', 'title' => 'Kesesuaian Ide'])
                    ->addColumn(['data' => 'Urgensi_permasalahan', 'name' => 'Urgensi_permasalahan', 'title' => 'Urgensi Permasalahan']);
                }
                elseif($cekkategori->kategori_id==8){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'Penjelasan_Problem_Bisnis', 'name' => 'Penjelasan_Problem_Bisnis', 'title' => 'Penjelasan Problem Bisnis'])
                    ->addColumn(['data' => 'Produk_Layanan', 'name' => 'Produk_Layanan', 'title' => 'Produk atau Layanan'])
                    ->addColumn(['data' => 'Pasar_Market', 'name' => 'Pasar_Market', 'title' => 'Pasar/Market'])
                    ->addColumn(['data' => 'Strategi_Bisnis', 'name' => 'Strategi_Bisnis', 'title' => 'Strategi Bisnis'])
                    ->addColumn(['data' => 'Anggota_Perusahaan', 'name' => 'Anggota_Perusahaan', 'title' => 'Anggota Perusahaan'])
                    ->addColumn(['data' => 'Daya_Tarik_Traction', 'name' => 'Daya_Tarik_Traction', 'title' => 'Daya Tarik atau Traksi'])
                    ->addColumn(['data' => 'Elevator_Pitch', 'name' => 'Elevator_Pitch', 'title' => 'Elevator Pitch']);
                }
                elseif($cekkategori->kategori_id==9){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'Aspek_kreativitas', 'name' => 'Aspek_kreativitas', 'title' => 'Aspek kreativitas'])
                    ->addColumn(['data' => 'Penulisan_proposal', 'name' => 'Penulisan_proposal', 'title' => 'Penulisan proposal'])
                    ->addColumn(['data' => 'Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'name' => 'Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'title' => 'Potensi Kegunaan Hasil Bagi Masyarakat'])
                    ->addColumn(['data' => 'Kemungkinan_Proposal_Dapat_Diselesaikan', 'name' => 'Kemungkinan_Proposal_Dapat_Diselesaikan', 'title' => 'Kemungkinan Proposal dapat diselesaikan']);
                }
                elseif($cekkategori->kategori_id==10){
                    $html = $htmlBuilder
                    ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                    ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                    ->addColumn(['data' => 'Permasalahan_yang_diangkat', 'name' => 'Permasalahan_yang_diangkat', 'title' => 'Permasalahan yang diangkat'])
                    ->addColumn(['data' => 'Pemaparan_permasalahan', 'name' => 'Pemaparan_permasalahan', 'title' => 'Pemaparan permasalahan'])
                    ->addColumn(['data' => 'Dampak_implementasi', 'name' => 'Dampak_implementasi', 'title' => 'Dampak implementasi'])
                    ->addColumn(['data' => 'Inovasi_pengembangan', 'name' => 'Inovasi_pengembangan', 'title' => 'Inovasi Pengembangan']);
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

            $animasi = Proposal::where('kategori_id',Kategori::where('nama_kategori','Animasi')->first()->id);
            $ux = Proposal::where('kategori_id',Kategori::where('nama_kategori','Desain Pengalaman Pengguna(UX)')->first()->id);
            $kjsi = Proposal::where('kategori_id',Kategori::where('nama_kategori','Keamanan Jaringan dan Sistem Informasi')->first()->id);
            $cp = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pemrograman')->first()->id);
            $datmin = Proposal::where('kategori_id',Kategori::where('nama_kategori','Penambangan Data(Data Mining)')->first()->id);
            $gamedev = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Aplikasi Permainan')->first()->id);
            $bistik = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Perangkat Lunak')->first()->id);
            $ppl = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Bisnis TIK')->first()->id);
            $piranti = Proposal::where('kategori_id',Kategori::where('nama_kategori','Piranti Cerdas, Sistem Benam dan IoT')->first()->id);
            $smartcity = Proposal::where('kategori_id',Kategori::where('nama_kategori','Kota Cerdas (Smart City)')->first()->id);

            return view('dashboard.admin', compact('animasi', 'ux', 'kjsi', 'cp','datmin','gamedev','bistik','ppl','piranti','smartcity'));
        }

        if (Laratrust::hasRole('dosen')) {

            $animasi = Proposal::where('kategori_id',Kategori::where('nama_kategori','Animasi')->first()->id);
            $ux = Proposal::where('kategori_id',Kategori::where('nama_kategori','Desain Pengalaman Pengguna(UX)')->first()->id);
            $kjsi = Proposal::where('kategori_id',Kategori::where('nama_kategori','Keamanan Jaringan dan Sistem Informasi')->first()->id);
            $cp = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pemrograman')->first()->id);
            $datmin = Proposal::where('kategori_id',Kategori::where('nama_kategori','Penambangan Data(Data Mining)')->first()->id);
            $gamedev = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Aplikasi Permainan')->first()->id);
            $bistik = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Perangkat Lunak')->first()->id);
            $ppl = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Bisnis TIK')->first()->id);
            $piranti = Proposal::where('kategori_id',Kategori::where('nama_kategori','Piranti Cerdas, Sistem Benam dan IoT')->first()->id);
            $smartcity = Proposal::where('kategori_id',Kategori::where('nama_kategori','Kota Cerdas (Smart City)')->first()->id);
            $kti = Proposal::where('kategori_id',Kategori::where('nama_kategori','Karya Tulis Ilmiah TIK')->first()->id);

            return view('dashboard.dosen', compact('animasi', 'ux', 'kjsi', 'cp','datmin','gamedev','bistik','ppl','piranti','smartcity','kti'));
        }
        return view('login');
    }
}
