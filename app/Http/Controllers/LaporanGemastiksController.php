<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Kategori;
use App\Review;
use App\RiwayatLaporan;
use App\User;
use App\LaporanGemastik;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BookException;
use Laratrust\LaratrustFacade as Laratrust;
use Session;
use Excel;
use PDF;
use Validator;
use Alert;

class LaporanGemastiksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if (Laratrust::hasRole('member')) {
            $revisi = LaporanGemastik::where('user_id', Auth::user()->id)->first();
            if ($revisi) {
                if ($request->ajax()) {
                    $proposals = LaporanGemastik::where('user_id', Auth::user()->id)->first();
                    $riwayats = RiwayatLaporan::where('laporan_id', $proposals->id)->with('laporan')->with('user');
                    return Datatables::of($riwayats)
                    ->addColumn('statusx', function($riwayat) {
                        return view('datatable._statusProposal', [
                            'model'             => $riwayat,
                        ]);
                    })
                    ->addColumn('keteranganx', function($riwayat) {
                        return view('datatable._keterangan', [
                            'model'             => $riwayat,
                        ]);
                    })
                    ->rawColumns(['statusx','keteranganx'])
                    ->orderBy('updated_at','desc')->make(true);
                }

                $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal Input'])
                ->addColumn(['data' => 'user.name', 'name' => 'user_id', 'title' => 'Pemeriksa/Pemohon','orderable' => false])
                ->addColumn(['data' => 'laporan.judul', 'name' => 'proposal_id', 'title' => 'Judul'])
                ->addColumn(['data' => 'statusx', 'name' => 'statusx', 'title' => 'Status','orderable' => false])
                ->addColumn(['data' => 'keteranganx', 'name' => 'keteranganx', 'title' => 'Keterangan','orderable' => false]);
            
                return view('laporanGemastik.index')->with(compact('html', 'revisi'));
            }
            else return redirect()->route('laporan.create');
        }
        if (Laratrust::hasRole('admin')) {
            if ($request->ajax()) {

                $proposals = Proposal::with('kategori')->with('user')->orderBy('updated_at', 'desc');
    
                return Datatables::of($proposals)
                    ->addColumn('action', function($proposal) {
                        return view('datatable._actionAdminProposal', [
                            'model'             => $proposal,
                            'form_url'          => route('proposalz.destroy', $proposal->id),
                            'edit_url'          => route('proposalz.edit', $proposal->id),
                            'view_url'          => route('proposalz.show', $proposal->id),
                            'confirm_message'    => 'Yakin mau menghapus ' . $proposal->judul . '?'
                        ]);
                })->make(true);
            }
    
            $html = $htmlBuilder
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
                ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul'])
                ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori.nama_kategori', 'title' => 'Kategori','orderable' => false])
                ->addColumn(['data' => 'user.name', 'name' => 'user_id', 'title' => 'Nama Tim'])
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal Input']);
                
            return view('proposals.index')->with(compact('html'));
        }
        if (Laratrust::hasRole('staff')) {
            if ($request->ajax()) {

                $proposals = Proposal::with('kategori')->with('user');
    
                return Datatables::of($proposals)
                    ->addColumn('action', function($proposal) {
                        return view('datatable._actionStaffProposal', [
                            'model'             => $proposal,
                           // 'form_url'          => route('proposals.destroy', $proposal->id),
                           // 'edit_url'          => route('proposals.edit', $proposal->id),
                            'view_url'          => route('proposals.show', $proposal->id),
                          //  'confirm_message'    => 'Yakin mau menghapus ' . $proposal->judul . '?'
                        ]);
                    })
                    ->addColumn('status', function($proposal) {
                    return view('datatable._actionReview',[
                        'model'             => $proposal,
                        'proposal_id'          => $proposal->id,
                    ]);
                })->rawColumns(['action','status'])->make(true);
            }
    
            $html = $htmlBuilder
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
                ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul'])
                ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori_id', 'title' => 'Kategori'])
                ->addColumn(['data' => 'user.name', 'name' => 'user_id', 'title' => 'Nama Tim'])
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal Input'])
                ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status','orderable' => false, 'searchable' => false]);
                
            return view('proposals.index')->with(compact('html'));
        }
    }
    public function indexDosen(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $proposals = LaporanGemastik::with('kategori')->with('user')->orderBy('updated_at','desc');

            return Datatables::of($proposals)
                ->addColumn('action', function($proposal) {
                    return view('datatable._actionDosen', [
                        'model'             => $proposal,
                        'edit_url'          => route('dosen.laporans.show', $proposal->id),
                        // 'view_url'          => route('proposals.show', $proposal->id),
                        'confirm_message'    => 'Yakin mau menghapus ' . $proposal->judul . '?'
                    ]);
            })
            //     ->addColumn('status', function($proposal) {
            //         return view('datatable._actionReview',[
            //             'model'             => $proposal,
            //             'proposal_id'          => $proposal->id,
            //         ]);
            // })
            //     ->addColumn('frekuensi', function($proposal) {
            //         return view('datatable._actionFrekuensi',[
            //             'model'             => $proposal,
            //             'proposal_id'          => $proposal->id,
            //         ]);
            // })
           // ->rawColumns(['action','status','frekuensi'])
            ->make(true);
        } 

        $html = $htmlBuilder
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
            ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori.nama_kategori', 'title' => 'Kategori','orderable' => false])
            ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul'])
            ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Nama Tim','orderable' => false])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal Input']);
            ///->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status', 'orderable' => false,'searchable' => false])
            //->addColumn(['data' => 'frekuensi', 'name' => 'frekuensi', 'title' => 'Reviewed by me', 'orderable' => false, 'searchable' => false]);
            

        return view('laporanGemastik.laporan')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = LaporanGemastik::where('user_id', Auth::user()->id)->count();
        if($count==0){
            return view('laporanGemastik.create');
        }
        else{
            return redirect()->route('laporan.index');
        }
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
            'judul' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'laporan' => 'required|mimes:pdf|max:10240',
        ], [
            'judul.required' => 'Judul proposal masih kosong',
            'kategori_id.required' => 'Kategori Lomba masih kosong',
            'kategori_id.exists' => 'Kategori Lomba tidak ada',
            'laporan.mimes' => 'proposal harus format pdf',
            'laporan.max' => 'Size proposal terlalu besar'
        ]);

        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')) {
            $available = LaporanGemastik::where('user_id',$request->input('user_id'));
            // if($available->count()>0)
            //     return redirect()->back();
            // else
                $laporan = LaporanGemastik::create($request->except('laporan'));
                $user = $request->input('user_id');
        }
        else{
            $user = Auth::user()->id;
            $laporan = LaporanGemastik::create($request->except('laporan','user_id'));
            $laporan->user_id = $user;
        }
        
        
        // Isi field upload jika ada proposal yang diupload
        if ($request->hasFile('laporan')) {

            // Mengambil file yang diupload
            $uploaded_upload = $request->file('laporan');

            // Mengambil extension file
            $extension = $uploaded_upload->getClientOriginalExtension();

            // Membuat nama file random berikut extension
            $filename = md5(time()) . "." . $extension;

            // Menyimpan proposal ke folder public/proposal
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'laporan';
            $uploaded_upload->move($destinationPath, $filename);

            // Mengisi field upload di tabel proposal dengan filename yang baru dibuat
            $laporan->laporan = $filename;
            $laporan->save();
        }
        $laporan_id = LaporanGemastik::where('user_id',$user)->first();
        $riwayat = new RiwayatLaporan;
        $riwayat->user_id = $user;
        $riwayat->laporan_id = $laporan_id->id;
        $riwayat->status = 'Submit laporan';
        $riwayat->keterangan = 'Mengajukan laporan';
        $riwayat->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $laporan->judul"
        ]);
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('laporanz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('laporans.index');
        }
        elseif (Laratrust::hasRole('member')) {
            return redirect()->route('laporan.index');
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
        $count = LaporanGemastik::where('id',$id)->get()->count();
        
        if($count==0){
            return redirect()->route('dosen.laporans.index');
        }
        else{
            $revisi = LaporanGemastik::find($id);
            $proposal = LaporanGemastik::find($id);
            $proposallama = Proposal::where('user_id',$revisi->user_id)->first();
            $kategori = Kategori::find($revisi->kategori_id);
            $team = User::where('id',$revisi->user_id)->first();
            if (Laratrust::hasRole('admin')) {
                return view('komentarLaporan.view')->with(compact('revisi','proposal', 'kategori','team'));
            }
            elseif (Laratrust::hasRole('staff')) {
                return view('komentarLaporan.view')->with(compact('revisi','proposal', 'kategori','team'));
            }
            elseif (Laratrust::hasRole('dosen')) {       
                return view('komentarLaporan.view')->with(compact('revisi','proposal','proposallama', 'kategori','team'));   
            }
            else{
                return redirect()->route('proposal.index');
            }
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laporan = LaporanGemastik::findOrfail($id);
        if (Laratrust::hasRole('admin')) {
            return view('laporanGemastik.edit')->with(compact('laporan'));
        }
        if (Laratrust::hasRole('staff')) {
            return view('laporanGemastik.edit')->with(compact('laporan'));
        }
        if (Laratrust::hasRole('member')) {
            $carilaporan = LaporanGemastik::where('user_id', Auth::user()->id)->first();
            if($carilaporan->id==$id)
            return view('laporanGemastik.edit')->with(compact('laporan'));
            else
            return redirect()->route('laporan.index');
        }
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
        $this->validate($request, [
            'judul' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'laporan' => 'mimes:pdf|max:10240',
        ], [
            'judul.required' => 'Judul proposal masih kosong',
            'kategori_id.required' => 'Kategori Lomba masih kosong',
            'kategori_id.exists' => 'Kategori Lomba tidak ada',
            'laporan.mimes' => 'proposal harus format pdf',
            'laporan.max' => 'Size proposal terlalu besar'
        ]);
        
        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')) {
            $available = LaporanGemastik::where('user_id',$request->input('user_id'));
            $user = $request->input('user_id');
        }
        if (Laratrust::hasRole('member')) {
            $user = Auth::user()->id;
            // if ($request->file('laporan')->getClientOriginalExtension()!='pdf') {
            //     return redirect()->route('laporan.edit');
            // }
        }


        $laporan = LaporanGemastik::find($id);
        
        if(!$laporan->update($request->all())) return redirect()->back();

        // Isi field upload jika ada proposal yang diupload
        if ($request->hasFile('laporan')) {
            $user = Auth::user()->id;
            if ($request->file('laporan')->getClientOriginalExtension()!='pdf') {
                return redirect()->route('laporan.edit');
            }
            // Mengambil proposal yang diupload berikut ektensinya
            $filename = null;
            $uploaded_upload = $request->file('laporan');
            $extension = $uploaded_upload->getClientOriginalExtension();

            // Membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;

            // Menyimpan proposal ke folder public/proposal
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'laporan';
            $uploaded_upload->move($destinationPath, $filename);

            // Hapus proposal lama, jika ada
            if ($laporan->laporan) {
                $old_upload = $laporan->laporan;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'laporan' . DIRECTORY_SEPARATOR . $laporan->laporan;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }

            // Ganti field proposal dengan proposal yang baru
            $laporan->laporan = $filename;
            $laporan->save();
        }

        // $revisi = Review::where('proposal_id',$proposal->id)->get();
        // foreach ($revisi as $key) {
        //     $key->is_review=0;
        //     $key->save();
        // }

        $laporan_id = LaporanGemastik::where('user_id',$user)->first();
        $riwayat = new RiwayatLaporan;
        $riwayat->user_id = $user;
        $riwayat->laporan_id = $laporan_id->id;
        $riwayat->status = 'Revisi laporan';
        $riwayat->keterangan = 'Mengajukan laporan';
        $riwayat->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $laporan->judul"
        ]);
        //return redirect()->back()->with(session()->flash('status', 'Data proposal berhasil disimpan'));
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('laporanz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('laporans.index');
        }
        elseif (Laratrust::hasRole('member')) {
            return redirect()->route('laporan.index');
        }
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
