<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Kategori;
use App\Review;
use App\RiwayatProposal;
use App\User;
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

class ProposalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if (Laratrust::hasRole('member')) {
            $revisi = Proposal::where('user_id', Auth::user()->id)->first();
            if ($revisi) {
                if ($request->ajax()) {
                    $proposals = Proposal::where('user_id', Auth::user()->id)->first();
                    $riwayats = RiwayatProposal::where('proposal_id', $proposals->id)->with('proposal')->with('user');
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
                ->addColumn(['data' => 'proposal.judul', 'name' => 'proposal.judul', 'title' => 'Judul','orderable' => false])
                ->addColumn(['data' => 'statusx', 'name' => 'statusx', 'title' => 'Status','orderable' => false])
                ->addColumn(['data' => 'keteranganx', 'name' => 'keteranganx', 'title' => 'Keterangan','orderable' => false]);
            
                return view('proposals.index')->with(compact('html', 'revisi'));
            }
            else return redirect()->route('proposal.create');
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
                ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori_id', 'title' => 'Kategori'])
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

            $proposals = Proposal::with('kategori')->with('user')->orderBy('updated_at','desc');

            return Datatables::of($proposals)
                ->addColumn('action', function($proposal) {
                    return view('datatable._actionDosen', [
                        'model'             => $proposal,
                        'edit_url'          => route('dosen.proposals.show', $proposal->id),
                        // 'view_url'          => route('proposals.show', $proposal->id),
                        'confirm_message'    => 'Yakin mau menghapus ' . $proposal->judul . '?'
                    ]);
            })
                ->addColumn('status', function($proposal) {
                    return view('datatable._actionReview',[
                        'model'             => $proposal,
                        'proposal_id'          => $proposal->id,
                    ]);
            })
                ->addColumn('frekuensi', function($proposal) {
                    return view('datatable._actionFrekuensi',[
                        'model'             => $proposal,
                        'proposal_id'          => $proposal->id,
                    ]);
            })->rawColumns(['action','status','frekuensi'])->make(true);
        } 

        $html = $htmlBuilder
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
            ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori.nama_kategori', 'title' => 'Kategori','orderable' => false])
            ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul'])
            ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Nama Tim','orderable' => false])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal Input'])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status', 'orderable' => false,'searchable' => false])
            ->addColumn(['data' => 'frekuensi', 'name' => 'frekuensi', 'title' => 'Reviewed by me', 'orderable' => false, 'searchable' => false]);
            

        return view('proposals.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = Proposal::where('user_id', Auth::user()->id)->count();
        if($count==0){
            return view('proposals.create');
        }
        else{
            return redirect()->route('proposal.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProposalRequest $request)
    {
        $this->validate($request, [
            'judul' => 'required:proposals,judul',
            'kategori_id' => 'required|exists:kategoris,id',
            'upload' => 'required|mimes:pdf|max:10240'
        ], [
            'judul.required' => 'Judul proposal masih kosong',
            'kategori_id.required' => 'Kategori Lomba masih kosong',
            'kategori_id.exists' => 'Kategori Lomba tidak ada',
            'upload.mimes' => 'proposal harus format pdf',
            'upload.max' => 'Size proposal terlalu besar'
        ]);

        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')) {
            $available = Proposal::where('user_id',$request->input('user_id'));
            // if($available->count()>0)
            //     return redirect()->back();
            // else
                $proposal = Proposal::create($request->except('upload'));
                $user = $request->input('user_id');
        }
        else{
            $user = Auth::user()->id;
            $proposal = Proposal::create($request->except('upload','user_id'));
            $proposal->user_id = $user;
        }
        
        
        // Isi field upload jika ada proposal yang diupload
        if ($request->hasFile('upload')) {

            // Mengambil file yang diupload
            $uploaded_upload = $request->file('upload');

            // Mengambil extension file
            $extension = $uploaded_upload->getClientOriginalExtension();

            // Membuat nama file random berikut extension
            $filename = md5(time()) . "." . $extension;

            // Menyimpan proposal ke folder public/proposal
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'proposal';
            $uploaded_upload->move($destinationPath, $filename);

            // Mengisi field upload di tabel proposal dengan filename yang baru dibuat
            $proposal->upload = $filename;
            $proposal->save();
        }
        $proposal_id = Proposal::where('user_id',$user)->first();
        $riwayat = new RiwayatProposal;
        $riwayat->user_id = $user;
        $riwayat->proposal_id = $proposal_id->id;
        $riwayat->status = 'Submit proposal';
        $riwayat->keterangan = 'Mengajukan proposal';
        $riwayat->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $proposal->judul"
        ]);
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('proposalz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('proposals.index');
        }
        elseif (Laratrust::hasRole('member')) {
            return redirect()->route('proposal.index');
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
        $count = Proposal::where('id',$id)->get()->count();
        
        if($count==0){
            return redirect()->route('dosen.proposals.index');
        }
        else{
            $proposal = Proposal::find($id);
            $kategori = Kategori::find($proposal->kategori_id);
            $team = User::where('id',$proposal->user_id)->first();
            if (Laratrust::hasRole('admin')) {
                return view('komentars.view')->with(compact('proposal', 'kategori','team'));
            }
            elseif (Laratrust::hasRole('staff')) {
                return view('komentars.view')->with(compact('proposal', 'kategori','team'));
            }
            elseif (Laratrust::hasRole('dosen')) {       
                return view('komentars.view')->with(compact('proposal', 'kategori','team'));   
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
        $proposal = Proposal::findOrfail($id);
        if (Laratrust::hasRole('admin')) {
            return view('proposals.edit')->with(compact('proposal'));
        }
        if (Laratrust::hasRole('staff')) {
            return view('proposals.edit')->with(compact('proposal'));
        }
        if (Laratrust::hasRole('member')) {
            $cariproposal = Proposal::where('user_id', Auth::user()->id)->first();
            if($cariproposal->id==$id)
            return view('proposals.edit')->with(compact('proposal'));
            else
            return redirect()->route('proposal.index');
        }
    }

    public function editproposal($id)
    {  
        session()->flash('status', 'Data proposal berhasil disimpan');
        $cariproposal = Proposal::where('user_id', Auth::user()->id)->first();
        $proposal = Proposal::find($id);
        if($cariproposal->id==$id)
            return view('proposals.edit')->with(compact('proposal'));
        else
            return redirect()->route('proposal.index');
    }
    public function editgagal($id)
    {  
        session()->flash('warning', 'Upload file proposal dalam bentuk PDF dan maksimal 10 MB');
        $cariproposal = Proposal::where('user_id', Auth::user()->id)->first();
        $proposal = Proposal::find($id);
        if($cariproposal->id==$id){
            return view('proposals.edit')->with(compact('proposal'));
        }  
        else
            return redirect()->route('proposal.index');
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
            'judul' => 'required:proposals,judul',
            'kategori_id' => 'required|exists:kategoris,id',
            'upload' => 'required|mimes:pdf'
        ], [
            'judul.required' => 'Judul proposal masih kosong',
            'kategori_id.required' => 'Kategori Lomba masih kosong',
            'kategori_id.exists' => 'Kategori Lomba tidak ada',
            'upload.mimes' => 'proposal harus format pdf',
        ]);
        
        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')) {
            $available = Proposal::where('user_id',$request->input('user_id'));
            $user = $request->input('user_id');
        }
        if (Laratrust::hasRole('member')) {
            $user = Auth::user()->id;
            if ($request->file('upload')->getClientOriginalExtension()!='pdf') {
                return redirect()->route('mahasiswa.proposals.edits', $id);
            }
        }


        $proposal = Proposal::find($id);
        
        if(!$proposal->update($request->all())) return redirect()->back();

        // Isi field upload jika ada proposal yang diupload
        if ($request->hasFile('upload')) {

            // Mengambil proposal yang diupload berikut ektensinya
            $filename = null;
            $uploaded_upload = $request->file('upload');
            $extension = $uploaded_upload->getClientOriginalExtension();

            // Membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;

            // Menyimpan proposal ke folder public/proposal
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'proposal';
            $uploaded_upload->move($destinationPath, $filename);

            // Hapus proposal lama, jika ada
            if ($proposal->upload) {
                $old_upload = $proposal->upload;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'proposal' . DIRECTORY_SEPARATOR . $proposal->upload;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }

            // Ganti field proposal dengan proposal yang baru
            $proposal->upload = $filename;
            $proposal->save();
        }

        $revisi = Review::where('proposal_id',$proposal->id)->get();
        foreach ($revisi as $key) {
            $key->is_review=0;
            $key->save();
        }

        $proposal_id = Proposal::where('user_id',$user)->first();
        $riwayat = new RiwayatProposal;
        $riwayat->user_id = $user;
        $riwayat->proposal_id = $proposal_id->id;
        $riwayat->status = 'Submit proposal';
        $riwayat->keterangan = 'Mengajukan proposal';
        $riwayat->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $proposal->judul"
        ]);
        //return redirect()->back()->with(session()->flash('status', 'Data proposal berhasil disimpan'));
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('proposalz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('proposals.index');
        }
        elseif (Laratrust::hasRole('member')) {
            return redirect()->route('mahasiswa.proposals.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $proposal = Proposal::find($id);

        $upload = $proposal->upload;

        if (!$proposal->delete()) return redirect()->back();

        // Handle hapus Proposal via ajax
        if ($request->ajax()) return response()->json(['id' => $id]);

        // Hapus Proposal lama, jika ada
        if ($upload) {

            $old_upload = $proposal->upload;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'proposal' . DIRECTORY_SEPARATOR . $proposal->upload;

            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
            }
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Proposal berhasil dihapus"
        ]);
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('proposalz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('proposals.index');
        }
    }
}
