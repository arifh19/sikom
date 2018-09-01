<?php

namespace App\Http\Controllers;
use App\Team;
use App\Kategori;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request, Builder $htmlBuilder)
    {   
        if (Laratrust::hasRole('admin')) {
            if ($request->ajax()) {

                $teams = Team::with('user')->with('kategori');

                return Datatables::of($teams)
                    ->addColumn('action', function($team) {
                        return view('datatable._actionAdmin', [
                            'model'             => $team,
                            'form_url'          => route('teamz.destroy', $team->id),
                            'edit_url'          => route('teamz.edit', $team->id),
                            'view_url'          => route('teamz.show', $team->id),
                            'confirm_message'    => 'Yakin mau menghapus ' . $team->user->name . '?'
                        ]);
                })->make(true);
            }

            $html = $htmlBuilder
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
                ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Nama Tim'])
                ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori_id', 'title' => 'Nama Kategori'])
                ->addColumn(['data' => 'nama_dosbing', 'name' => 'nama_dosbing', 'title' => 'Nama Dosen Pembimbing']);
                
            return view('teams.index')->with(compact('html'));
        }
        if (Laratrust::hasRole('staff')) {
            if ($request->ajax()) {

                $teams = Team::with('user')->with('kategori');

                return Datatables::of($teams)
                    ->addColumn('action', function($team) {
                        return view('datatable._actionStaff', [
                            'model'             => $team,
                            'edit_url'          => route('teams.edit', $team->id),
                            'view_url'          => route('teams.show', $team->id),
                            'confirm_message'    => 'Yakin mau menghapus ' . $team->user->name . '?'
                        ]);
                })->make(true);
            }

            $html = $htmlBuilder
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
                ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Nama Tim'])
                ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori_id', 'title' => 'Nama Kategori'])
                ->addColumn(['data' => 'nama_dosbing', 'name' => 'nama_dosbing', 'title' => 'Nama Dosen Pembimbing']);
                
            return view('teams.index')->with(compact('html'));
        }
        if (Laratrust::hasRole('dosen')) {
            if ($request->ajax()) {

                $teams = Team::with('user')->with('kategori');

                return Datatables::of($teams)
                    ->addColumn('action', function($team) {
                        return view('datatable._actionDosenTim', [
                            'model'             => $team,
                            'view_url'          => route('dosen.teams.show', $team->id),
                            'confirm_message'    => 'Yakin mau menghapus ' . $team->user->name . '?'
                        ]);
                })->make(true);
            }

            $html = $htmlBuilder
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
                ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Nama Tim'])
                ->addColumn(['data' => 'kategori.nama_kategori', 'name' => 'kategori_id', 'title' => 'Nama Kategori'])
                ->addColumn(['data' => 'nama_dosbing', 'name' => 'nama_dosbing', 'title' => 'Nama Dosen Pembimbing']);
                
            return view('teams.index')->with(compact('html'));
        }
        if (Laratrust::hasRole('member')) {
            $team = Team::where('user_id', Auth::user()->id)->first();
            $hitung = Team::where('user_id', Auth::user()->id)->count();
            if($hitung==1)
            return view('teams.team')->with(compact('team'));
            else
            return view('teams.create');
        }   
        return redirect()->route('logout');
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
        $this->validate($request, [
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_ketua' => 'required:teams',
            'nim_ketua' => 'required:teams',
            'fkja_ketua' => 'required:teams',
            'no_hp_ketua' => 'required:teams',
            'foto_ktm_ketua' => 'required|image|max:1024',
            'foto_ktm_anggota1' => 'image|max:1024',
            'foto_ktm_anggota2' => 'image|max:1024',
        ], [
            'kategori_id.required' => 'Kategori Tim masih kosong',            
            'nama_ketua.required' => 'Nama Ketua Tim masih kosong',
            'nim_ketua.required' => 'Nim Ketua Tim masih kosong',
            'fkja_ketua.required' => 'Fakultas Ketua Tim masih kosong',
            'no_hp_ketua.required' => 'No HP masih kosong',
            'foto_ktm_ketua.required' => 'File KTM Ketua masih kosong',
            'foto_ktm_ketua.image' => 'Format File KTM harus Gambar',
            'foto_ktm_ketua.max' => 'Size proposal terlalu besar',
            'foto_ktm_anggota1.image' => 'Format File KTM harus Gambar',
            'foto_ktm_anggota1.max' => 'Size proposal terlalu besar',
            'foto_ktm_anggota2.image' => 'Format File KTM harus Gambar',
            'foto_ktm_anggota2.max' => 'Size proposal terlalu besar',
        ]);
        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')) {
            $available = Team::where('user_id',$request->input('user_id'));
            // if($available->count()>0)
            //     return redirect()->back();
            // else
                $team = Team::create($request->except('foto_ktm_ketua','foto_ktm_anggota1','foto_ktm_anggota2'));
        }
        if (Laratrust::hasRole('member')) {
            $team = Team::create($request->except('foto_ktm_ketua','foto_ktm_anggota1','foto_ktm_anggota2','user_id'));
            $user = Auth::user()->id;
            $team->user_id = $user; 
        }

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
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('teamz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('teams.index');
        }
        elseif (Laratrust::hasRole('member')) {
            return redirect()->route('team.index');
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
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_ketua' => 'required:teams',
            'nim_ketua' => 'required:teams',
            'fkja_ketua' => 'required:teams',
            'no_hp_ketua' => 'required:teams',
            'foto_ktm_ketua' => 'image|max:1024',
            'foto_ktm_anggota1' => 'image|max:1024',
            'foto_ktm_anggota2' => 'image|max:1024',
        ], [
            'kategori_id.required' => 'Kategori Tim masih kosong',            
            'nama_ketua.required' => 'Nama Ketua Tim masih kosong',
            'nim_ketua.required' => 'Nim Ketua Tim masih kosong',
            'fkja_ketua.required' => 'Fakultas Ketua Tim masih kosong',
            'no_hp_ketua.required' => 'No HP masih kosong',
            'foto_ktm_ketua.image' => 'Format File KTM harus Gambar',
            'foto_ktm_ketua.max' => 'Size proposal terlalu besar',
            'foto_ktm_anggota1.image' => 'Format File KTM harus Gambar',
            'foto_ktm_anggota1.max' => 'Size proposal terlalu besar',
            'foto_ktm_anggota2.image' => 'Format File KTM harus Gambar',
            'foto_ktm_anggota2.max' => 'Size proposal terlalu besar',
        ]);
        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')) {
            $available = Team::where('user_id',$request->input('user_id'));
            // if($available->count()>0)
            //     return redirect()->back();
        }
        $team = Team::find($id);
        
        if(!$team->update($request->all())) return redirect()->back();

        // Isi field upload jika ada proposal yang diupload
        if ($request->hasFile('foto_ktm_ketua')) {
            $filename = null;
            $uploaded_foto_ktm_ketua = $request->file('foto_ktm_ketua');
            $extension = $uploaded_foto_ktm_ketua->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'teams';
            $uploaded_foto_ktm_ketua->move($destinationPath, $filename);
            if ($team->foto_ktm_ketua) {
                $old_upload = $team->foto_ktm_ketua;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR . $team->foto_ktm_ketua;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }
            $team->foto_ktm_ketua = $filename;
            $team->save();
        }
        if ($request->hasFile('foto_ktm_anggota1')) {
            $filename = null;
            $uploaded_foto_ktm_anggota1 = $request->file('foto_ktm_anggota1');
            $extension = $uploaded_foto_ktm_anggota1->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'teams';
            $uploaded_foto_ktm_anggota1->move($destinationPath, $filename);
            if ($team->foto_ktm_anggota1) {
                $old_upload = $team->foto_ktm_anggota1;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR . $team->foto_ktm_anggota1;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }
            $team->foto_ktm_anggota1 = $filename;
            $team->save();
        }
        if ($request->hasFile('foto_ktm_anggota2')) {
            $filename = null;
            $uploaded_foto_ktm_anggota2 = $request->file('foto_ktm_anggota2');
            $extension = $uploaded_foto_ktm_anggota2->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'teams';
            $uploaded_foto_ktm_anggota2->move($destinationPath, $filename);
            if ($team->foto_ktm_anggota2) {
                $old_upload = $team->foto_ktm_anggota2;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR . $team->foto_ktm_anggota2;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }
            $team->foto_ktm_anggota2 = $filename;
            $team->save();
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $team->id"
        ]);
        if (Laratrust::hasRole('admin')) {
            return redirect()->route('teamz.index');
        }
        elseif (Laratrust::hasRole('staff')) {
            return redirect()->route('teams.index');
        }
        elseif (Laratrust::hasRole('member')) {
            return redirect()->route('team.index');
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
        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')||Laratrust::hasRole('dosen')) {
            $team = Team::find($id);
            return view('teams.team')->with(compact('team'));
        }
        if (Laratrust::hasRole('member')) {
            $team = Team::where('user_id', Auth::user()->id)->first();
            return view('teams.team')->with(compact('team'));
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
        if (Laratrust::hasRole('admin')||Laratrust::hasRole('staff')) {
            $team = Team::find($id);
            return view('teams.edit')->with(compact('team'));
        }
        if (Laratrust::hasRole('member')) {
            $cariteam = Team::where('user_id', Auth::user()->id)->first();
            $team = Team::find($id);
            if($cariteam->id==$id)
                return view('teams.edit')->with(compact('team'));
            else
                return redirect()->route('team.index');
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
        $team = Team::find($id);

        $foto_ktm_ketua = $team->foto_ktm_ketua;
        $foto_ktm_anggota1 = $team->foto_ktm_anggota1;
        $foto_ktm_anggota2 = $team->foto_ktm_anggota2;
        //$upload = $proposal->foto_ktm_ketua;

        if (!$team->delete()) return redirect()->back();

        // Handle hapus Proposal via ajax
        if ($request->ajax()) return response()->json(['id' => $id]);

        // Hapus Proposal lama, jika ada
        if ($foto_ktm_ketua) {

            $old_upload = $team->foto_ktm_ketua;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR . $team->foto_ktm_ketua;

            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
            }
        }
        if ($foto_ktm_anggota1) {

            $old_upload = $team->foto_ktm_anggota1;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR . $team->foto_ktm_anggota1;

            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
            }
        }
        if ($foto_ktm_anggota2) {

            $old_upload = $team->foto_ktm_anggota2;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR . $team->foto_ktm_anggota2;

            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
            }
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Team berhasil dihapus"
        ]);

        return redirect()->route('teamz.index');
    }
}
