<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komentar;
use App\Dokumen;
use App\Proposal;
use Illuminate\Support\Facades\Auth;
use Session;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Laratrust\LaratrustFacade as Laratrust;
use App\KomentarLaporan;

class KomentarLaporansController extends Controller
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
            'laporan_id' => 'required',
            'lampiran' => 'mimes:pdf,doc,docx|max:10240',
        ], [
            'laporan_id.required' => 'Komentar masih kosong',
            'lampiran.mimes' => 'Lampiran salah format',
            'lampiran.max' => 'Size terlalu besar',
        ]);

        $komentar = KomentarLaporan::create($request->except('user_id'));
        $komentar->user_id = Auth::user()->id;
        $komentar->save();

        // Auth::user()->review($komentar);

        // if ($request->hasFile('lampiran')) {
        //     $dokumen = new Dokumen;
        //     $dokumen->proposal_id = $request->input('laporan_id');
        //     $dokumen->komentar_id = $komentar->id;
        //     // Mengambil file yang diupload
        //     $uploaded_dokumen = $request->file('lampiran');

        //     // Mengambil extension file
        //     $extension = $uploaded_dokumen->getClientOriginalExtension();

        //     // Membuat nama file random berikut extension
        //     $filename = md5(time()) . "." . $extension;

        //     // Menyimpan proposal ke folder public/lampiran
        //     $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'lampiran';
        //     $uploaded_dokumen->move($destinationPath, $filename);

        //     // Mengisi field upload di tabel proposal dengan filename yang baru dibuat
        //     $dokumen->lampiran = $filename;
        //     $dokumen->save();
        // }

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $komentar->id"
        ]);
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('proposalz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('proposals.index');
        }
        elseif (Laratrust::hasRole('dosen')) {
            return redirect()->route('dosen.laporans.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
