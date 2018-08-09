<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komentar;
use App\Proposal;
use Illuminate\Support\Facades\Auth;
use Session;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class KomentarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'proposal_id' => 'required:komentars',
        ], [
            'proposal_id.required' => 'Komentar masih kosong',
        ]);

        $komentar = Komentar::create($request->except('user_id'));
        $komentar->user_id = Auth::user()->id;
        $komentar->save();

        Auth::user()->review($komentar);

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $komentar->id"
        ]);

        return redirect()->route('dosen.proposals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request, Builder $htmlBuilder)
    {
        $available = Proposal::where('id', $id)->get();
        $cekkategori = Proposal::where('id', $id)->first();
        if ($request->ajax()) {
            $komentar = Komentar::where('user_id', Auth::user()->id)->where('proposal_id',$id)->get();
            $komentars = Komentar::where('user_id', Auth::user()->id)->where('proposal_id',$id)->with('user');
            return Datatables::of($komentars)->make(true);
        }
        if ($available->count()>0) {
            if ($cekkategori->kategori_id==1) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'Ide_konsep_keaslian', 'name' => 'Ide_konsep_keaslian', 'title' => 'Ide Konsep Keaslian'])
                ->addColumn(['data' => 'Konsistensi_tema', 'name' => 'Konsistensi_tema', 'title' => 'Konsistensi Tema'])
                ->addColumn(['data' => 'Kreativitas_dalam_implementasi', 'name' => 'Kreativitas_dalam_implementasi', 'title' => 'Kreativitas dalam implementasi'])
                ->addColumn(['data' => 'Teknik_modelling_lighting_motion', 'name' => 'Teknik_modelling_lighting_motion', 'title' => 'Teknik (modelling,lighting,motion)'])
                ->addColumn(['data' => 'Kekuatan_pesan_artistik', 'name' => 'Kekuatan_pesan_artistik', 'title' => 'Kekuatan pesan artistik']);
            } elseif ($cekkategori->kategori_id==2) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'Identifikasi_permasalahan', 'name' => 'Identifikasi_permasalahan', 'title' => 'Identifikasi Permasalahan'])
                ->addColumn(['data' => 'Inovasi_desain', 'name' => 'Inovasi_desain', 'title' => 'Inovasi Desain'])
                ->addColumn(['data' => 'Metode_Desain', 'name' => 'Metode_Desain', 'title' => 'Metode Desain'])
            // ->addColumn(['data' => 'Prototype', 'name' => 'Prototype', 'title' => 'Low Fidelity Prototype'])
                ->addColumn(['data' => 'Komunikasi', 'name' => 'Komunikasi', 'title' => 'Komunikasi (PPV)']);
            } elseif ($cekkategori->kategori_id==5) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'originalitas', 'name' => 'originalitas', 'title' => 'Originalitas'])
                ->addColumn(['data' => 'kebaruan', 'name' => 'kebaruan', 'title' => 'Kebaruan'])
                ->addColumn(['data' => 'manfaat', 'name' => 'manfaat', 'title' => 'Manfaat'])
                ->addColumn(['data' => 'clarity', 'name' => 'clarity', 'title' => 'Clarity dalam tulisan'])
                ->addColumn(['data' => 'kelengkapan_laporan', 'name' => 'kelengkapan_laporan', 'title' => 'Kelengkapan Laporan']);
            } elseif ($cekkategori->kategori_id==6) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'Story', 'name' => 'Story', 'title' => 'Unsur pendidikan dan keterampilan'])
                ->addColumn(['data' => 'Mechanics', 'name' => 'Mechanics', 'title' => 'Kreativitas dalam pengembangan permainan'])
                ->addColumn(['data' => 'Aesthetics', 'name' => 'Aesthetics', 'title' => 'Unsur Aesthetics'])
                ->addColumn(['data' => 'Gameplay', 'name' => 'Gameplay', 'title' => 'Gameplay menarik dan menghibur'])
                ->addColumn(['data' => 'kesesuaian_proposal', 'name' => 'kesesuaian_proposal', 'title' => 'Kesesuaian fitur dengan Proposal']);
            } elseif ($cekkategori->kategori_id==7) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'Aspek_Inovasi', 'name' => 'Aspek_Inovasi', 'title' => 'Aspek Inovasi'])
                ->addColumn(['data' => 'Dampak_pengguna_masyarakat', 'name' => 'Dampak_pengguna_masyarakat', 'title' => 'Dampak penggunaan ke masyarakat'])
                ->addColumn(['data' => 'Desain_dan_usability', 'name' => 'Desain_dan_usability', 'title' => 'Desain antarmuka dan usability'])
                ->addColumn(['data' => 'metodologi_pengembangan', 'name' => 'metodologi_pengembangan', 'title' => 'Metodologi Pengembangan'])
                ->addColumn(['data' => 'Kesesuaian_ide', 'name' => 'Kesesuaian_ide', 'title' => 'Kesesuaian Ide'])
                ->addColumn(['data' => 'Urgensi_permasalahan', 'name' => 'Urgensi_permasalahan', 'title' => 'Urgensi Permasalahan']);
            } elseif ($cekkategori->kategori_id==8) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'Penjelasan_Problem_Bisnis', 'name' => 'Penjelasan_Problem_Bisnis', 'title' => 'Penjelasan Problem Bisnis'])
                ->addColumn(['data' => 'Produk_Layanan', 'name' => 'Produk_Layanan', 'title' => 'Produk atau Layanan'])
                ->addColumn(['data' => 'Pasar_Market', 'name' => 'Pasar_Market', 'title' => 'Pasar/Market'])
                ->addColumn(['data' => 'Strategi_Bisnis', 'name' => 'Strategi_Bisnis', 'title' => 'Strategi Bisnis'])
                ->addColumn(['data' => 'Anggota_Perusahaan', 'name' => 'Anggota_Perusahaan', 'title' => 'Anggota Perusahaan'])
                ->addColumn(['data' => 'Daya_Tarik_Traction', 'name' => 'Daya_Tarik_Traction', 'title' => 'Daya Tarik atau Traksi'])
                ->addColumn(['data' => 'Elevator_Pitch', 'name' => 'Elevator_Pitch', 'title' => 'Elevator Pitch']);
            } elseif ($cekkategori->kategori_id==9) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'Aspek_kreativitas', 'name' => 'Aspek_kreativitas', 'title' => 'Aspek kreativitas'])
                ->addColumn(['data' => 'Penulisan_proposal', 'name' => 'Penulisan_proposal', 'title' => 'Penulisan proposal'])
                ->addColumn(['data' => 'Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'name' => 'Potensi_Kegunaan_Hasil_Bagi_Masyarakat', 'title' => 'Potensi Kegunaan Hasil Bagi Masyarakat'])
                ->addColumn(['data' => 'Kemungkinan_Proposal_Dapat_Diselesaikan', 'name' => 'Kemungkinan_Proposal_Dapat_Diselesaikan', 'title' => 'Kemungkinan Proposal dapat diselesaikan']);
            } elseif ($cekkategori->kategori_id==10) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'Permasalahan_yang_diangkat', 'name' => 'Permasalahan_yang_diangkat', 'title' => 'Permasalahan yang diangkat'])
                ->addColumn(['data' => 'Pemaparan_permasalahan', 'name' => 'Pemaparan_permasalahan', 'title' => 'Pemaparan permasalahan'])
                ->addColumn(['data' => 'Dampak_implementasi', 'name' => 'Dampak_implementasi', 'title' => 'Dampak implementasi'])
                ->addColumn(['data' => 'Inovasi_pengembangan', 'name' => 'Inovasi_pengembangan', 'title' => 'Inovasi Pengembangan']);
            } elseif ($cekkategori->kategori_id==11) {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa'])
                ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul'])
                ->addColumn(['data' => 'abstrak', 'name' => 'abstrak', 'title' => 'Abstrak'])
                ->addColumn(['data' => 'pendahuluan', 'name' => 'pendahuluan', 'title' => 'Pendahuluan'])
                ->addColumn(['data' => 'tujuan', 'name' => 'tujuan', 'title' => 'Tujuan'])
                ->addColumn(['data' => 'metode', 'name' => 'metode', 'title' => 'Metode'])
                ->addColumn(['data' => 'hasil_pembahasan', 'name' => 'hasil_pembahasan', 'title' => 'Hasil dan Pembahasan'])
                ->addColumn(['data' => 'kesimpulan', 'name' => 'kesimpulan', 'title' => 'Kesimpulan'])
                ->addColumn(['data' => 'daftar_pustaka', 'name' => 'daftar_pustaka', 'title' => 'Daftar Pustaka']);
            } else {
                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal diperiksa']);
            }
        } 
        else{
            return redirect()->route('dosen.proposals.index');
        }
    
        return view('komentars.index', compact('komentar','html','cekkategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
