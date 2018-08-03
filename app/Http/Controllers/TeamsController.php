<?php

namespace App\Http\Controllers;
use App\Team;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateProposalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BookException;
use Laratrust\LaratrustFacade as Laratrust;
use Session;
use Excel;
use PDF;
use Validator;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $team = Team::where('user_id', Auth::user()->id)->first();
        $hitung = Team::where('user_id', Auth::user()->id)->count();
        if($hitung==1)
        return view('teams.team')->with(compact('team'));
        else
        return view('teams.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->except('foto_ktm_ketua','foto_ktm_anggota1','foto_ktm_anggota2','user_id'));
        $user = Auth::user()->id;
        $team->user_id = $user;
        $team->save();
        // Isi field upload jika ada proposal yang diupload
        if ($request->hasFile('foto_ktm_ketua')) {
            $uploaded_foto_ktm_ketua = $request->file('foto_ktm_ketua');
            $extension = $uploaded_foto_ktm_ketua->getClientOriginalExtension();
            $filename = md5(time()) . "." . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'teams';
            $uploaded_foto_ktm_ketua->move($destinationPath, $filename);
            $team->foto_ktm_ketua = $filename;
        }
        if ($request->hasFile('foto_ktm_anggota1')) {
            $uploaded_foto_ktm_anggota1 = $request->file('foto_ktm_anggota1');
            $extension = $uploaded_foto_ktm_anggota1->getClientOriginalExtension();
            $filename = md5(time()+1) . "." . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'teams';
            $uploaded_foto_ktm_anggota1->move($destinationPath, $filename);
            $team->foto_ktm_anggota1 = $filename;
        }
        if ($request->hasFile('foto_ktm_anggota2')) {
            $uploaded_foto_ktm_anggota2 = $request->file('foto_ktm_anggota2');
            $extension = $uploaded_foto_ktm_anggota2->getClientOriginalExtension();
            $filename = md5(time()+2) . "." . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'teams';
            $uploaded_foto_ktm_anggota2->move($destinationPath, $filename);
            $team->foto_ktm_anggota2 = $filename;
        }
        $team->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $team->nama_ketua"
        ]);

        return redirect()->route('teams.index');
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
        $user = Auth::user()->id;
        $team = Team::find($id);
        if($team->user_id==$user)
        return view('teams.edit')->with(compact('team'));
        else
        return redirect()->route('teams.index');

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
