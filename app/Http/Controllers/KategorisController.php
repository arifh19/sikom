<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;


class KategorisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $kategoris = Kategori::select(['id', 'nama_kategori']);

            return Datatables::of($kategoris)
            ->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_kategori', 'name' => 'nama_kategori', 'title' => 'Kategori']);

        return view('kategoris.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoris.create');
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
            'nama_kategori' => 'required|unique:kategoris'
        ], [
            'nama_kategori.required' => 'Kategori masih kosong',
            'nama_kategori.unique' => 'Kategori sudah ada'
        ]);

        $kategori = Kategori::create($request->only('nama_kategori'));

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $kategori->nama_kategori"
        ]);

        return redirect()->route('kategoris.index');
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
        $kategori = Kategori::find($id);

        return view('kategoris.edit')->with(compact('kategori'));
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
            'nama_kategori' => 'required|unique:kategoris'
        ], [
            'nama_kategori.required' => 'Kategori masih kosong',
            'nama_kategori.unique' => 'Kategori sudah ada'
        ]);

        $kategori = Kategori::find($id);

        $kategori->update($request->only('nama_kategori'));

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $kategori->nama_kategori"
        ]);

        return redirect()->route('kategoris.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Kategori::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Kategori berhasil dihapus"
        ]);

        return redirect()->route('kategoris.index');
    }
}
