<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;
use App\Author;
use App\Proposal;
use App\Kategori;
use App\Komentar;
use App\Role;
use App\BorrowLog;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if (Laratrust::hasRole('member')) {

            if ($request->ajax()) {
                $proposals = Proposal::where('user_id', Auth::user()->id)->first();
                $komentars = Komentar::where('proposal_id', $proposals->id)->with('user');
    
                return Datatables::of($komentars)->make(true);
            }
    
            $html = $htmlBuilder
                ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Tanggal Diperiksa'])
                ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => 'Pemeriksa'])
                ->addColumn(['data' => 'konten', 'name' => 'konten', 'title' => 'Komentar']);
                

            return view('dashboard.member', compact('proposals','html'));
        }

        if (Laratrust::hasRole('admin')) {

            $author = Author::all();

            $book = Book::all();

            $member = Role::where('name', 'member')->first()->users;

            $borrow = BorrowLog::all();

            return view('dashboard.admin', compact('author', 'book', 'member', 'borrow'));
        }

        if (Laratrust::hasRole('dosen')) {

            $animasi = Proposal::where('kategori_id',Kategori::where('nama_kategori','Animasi')->first()->id);
            $ux = Proposal::where('kategori_id',Kategori::where('nama_kategori','Desain Pengalaman Pengguna(UX)')->first()->id);
            $kjsi = Proposal::where('kategori_id',Kategori::where('nama_kategori','Keamanan Jaringan dan Sistem Informasi')->first()->id);
            $cp = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pemrograman')->first()->id);
            $datmin = Proposal::where('kategori_id',Kategori::where('nama_kategori','Penambangan Data(Data Mining)')->first()->id);
            $gamedev = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Aplikasi Permainan')->first()->id);
            $bistik = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Perangkat Lunak')->first()->id);
            $ppl = Proposal::where('kategori_id',Kategori::where('nama_kategori','Pengembangan Bisnis TIK')->first()->id);
            $piranti = Proposal::where('kategori_id',Kategori::where('nama_kategori','Piranti Cerdas, Sistem Benam dan IoT')->first()->id);
            $smartcity = Proposal::where('kategori_id',Kategori::where('nama_kategori','Kota Cerdas (Smart City)')->first()->id);

            return view('dashboard.dosen', compact('animasi', 'ux', 'kjsi', 'cp','datmin','gamedev','bistik','ppl','piranti','smartcity'));
        }
        return view('login');
    }
}
