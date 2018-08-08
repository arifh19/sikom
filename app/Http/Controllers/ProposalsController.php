<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposal;
use App\Kategori;
use App\Review;
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

class ProposalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $proposals = Proposal::where('user_id', Auth::user()->id)->with('kategori')->with('user');

            return Datatables::of($proposals)
                ->addColumn('action', function($proposal) {
                    return view('datatable._action', [
                        'model'             => $proposal,
                        //'form_url'          => route('proposals.destroy', $proposal->id),
                        'edit_url'          => route('proposals.edit', $proposal->id),
                        // 'view_url'          => route('proposals.show', $proposal->id),
                        'confirm_message'    => 'Yakin mau menghapus ' . $proposal->judul . '?'
                    ]);
            })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
            ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul'])
            ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori.nama_kategori', 'title' => 'Kategori'])
            ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Nama Tim'])
            ->addColumn(['data' => 'kategori.updated_at', 'name' => 'kategori.updated_at', 'title' => 'Tanggal Input']);
            

        return view('proposals.index')->with(compact('html'));
    }

    public function indexDosen(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $proposals = Proposal::with('kategori')->with('user');

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
            })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
            ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori.nama_kategori', 'title' => 'Kategori'])
            ->addColumn(['data' => 'judul', 'name' => 'judul', 'title' => 'Judul'])
            ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Nama Tim'])
            ->addColumn(['data' => 'kategori.updated_at', 'name' => 'kategori.updated_at', 'title' => 'Tanggal Input'])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status', 'orderable' => false, 'searchable' => false])  ;
            

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
            return redirect()->route('proposals.index');
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
        
        $proposal = Proposal::create($request->except('upload','user_id'));
        $user = Auth::user()->id;
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
            $proposal->user_id = $user;
            $proposal->save();
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $proposal->judul"
        ]);

        return redirect()->route('proposals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = Proposal::all()->count();
        
        if($count==0){
            return redirect()->route('proposals.index');
        }
        else{
            $proposal = Proposal::find($id);
            $kategori = Kategori::find($proposal->kategori_id);
            $team = User::where('id',$proposal->user_id)->first();
            if (Laratrust::hasRole('admin')) {
                return view('komentars.view')->with(compact('proposal', 'kategori','team'));
            }
            elseif (Laratrust::hasRole('dosen')) {
                return view('komentars.view')->with(compact('proposal', 'kategori','team'));
            }
            else{
                return redirect()->route('proposals.index');
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
        $cariproposal = Proposal::where('user_id', Auth::user()->id)->first();
        $proposal = Proposal::find($id);
        if($cariproposal->id==$id)
            return view('proposals.edit')->with(compact('proposal'));
        else
            return redirect()->route('proposals.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProposalRequest $request, $id)
    {
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

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $proposal->judul"
        ]);
        
        return redirect()->route('proposals.index');
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

        return redirect()->route('proposals.index');
    }
}
