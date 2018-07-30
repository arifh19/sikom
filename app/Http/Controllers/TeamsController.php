<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamsController extends Controller
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
        return view('teams.create');        
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
            'nama_ketua' => 'required:teams',
            'nim_ketua' => 'required:teams',
            'fkja_ketua' => 'required:teams',
            'no_hp_ketua' => 'required:teams',
            'foto_ktm_ketua' => 'required:teams',
        ], [
            'nama_ketua.required' => 'Nama penulis masih kosong',
            'nim_ketua.required' => 'Penulis sudah ada',
            'fkja_ketua.required' => 'Nama penulis masih kosong',
            'no_hp_ketua.required' => 'Penulis sudah ada',
            'foto_ktm_ketua.required' => 'Nama penulis masih kosong',
        ]);

        $team = Team::create($request->except('user_id'));

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
