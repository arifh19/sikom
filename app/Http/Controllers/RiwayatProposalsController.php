<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RiwayatProposal;
use App\Proposal;
use App\Reviewstaff;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Laratrust\LaratrustFacade as Laratrust;

class RiwayatProposalsController extends Controller
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
            'status' => 'required',
            'keterangan' => 'required'
        ], [
            'status.required' => 'status masih kosong',
            'keterangan.required' => 'keterangan masih kosong'
        ]);

        $riwayat = RiwayatProposal::create($request->except('user_id'));
        $riwayat->user_id = Auth::user()->id;
        $riwayat->save(); 
        
        $reviewstaff = new Reviewstaff;
        $reviewstaff->pengurus_id = $request->input('pengurus_id');
        $reviewstaff->divisi_id = 4;
        $reviewstaff->riwayat_proposal_id = $riwayat->id;
        $reviewstaff->save();

        Auth::user()->reviewStaff($riwayat);

        if (Laratrust::hasRole('staff')) {
            return redirect()->route('proposals.index');
        }elseif (Laratrust::hasRole('admin')) {
            return redirect()->route('proposalz.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Builder $htmlBuilder, $id)
    {
        $cekkategori = Proposal::where('id', $id)->first();
        if ($cekkategori) {
            if ($request->ajax()) {
                $riwayats = RiwayatProposal::where('proposal_id', $id)->with('proposal')->with('user');
                return Datatables::of($riwayats)
                ->addColumn('statusx', function($riwayat) {
                    return view('datatable._statusProposal', [
                        'model'             => $riwayat,
                    ]);
                })
                ->addColumn('pemeriksa', function($riwayat) {
                    return view('datatable._pemeriksa', [
                        'model'             => $riwayat,
                        'cekpengurus'             => Reviewstaff::where('riwayat_proposal_id',$riwayat->id),
                        'user'             => Auth::user()->where('id',$riwayat->user_id)->first(),
                    ]);
                })
                ->addColumn('keteranganx', function($riwayat) {
                    return view('datatable._keterangan', [
                        'model'             => $riwayat,
                    ]);
                })
                ->rawColumns(['statusx','keteranganx','pemeriksa'])->orderBy('updated_at','desc')->make(true);
            }

            $html = $htmlBuilder
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal Input'])
            ->addColumn(['data' => 'pemeriksa', 'name' => 'pemeriksa', 'title' => 'Pemeriksa/Pemohon','orderable' => false,'searchable' => false])
            ->addColumn(['data' => 'proposal.judul', 'name' => 'proposal.judul', 'title' => 'Judul','orderable' => false])
            ->addColumn(['data' => 'statusx', 'name' => 'status', 'title' => 'Status','orderable' => false])
            ->addColumn(['data' => 'keteranganx', 'name' => 'keterangan', 'title' => 'Keterangan','orderable' => false]);
        
            return view('komentars.index')->with(compact('html', 'cekkategori'));
        }
        else return redirect()->route('proposals.index');
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
