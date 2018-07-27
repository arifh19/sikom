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
                $proposals = Proposal::where('user_id', Auth::user()->id);
                $komentars = Komentar::where('proposal_id', 8)->with('user');
    
                return Datatables::of($komentars)
                    ->addColumn('action', function($komentar) {
                        return view('datatable._action', [
                            'model'             => $komentar,
                            'form_url'          => route('komentars.destroy', $komentar->id),
                            'edit_url'          => route('komentars.edit', $komentar->id),
                            // 'view_url'          => route('proposals.show', $proposal->id),
                            'confirm_message'    => 'Yakin mau menghapus ' . $komentar->konten . '?'
                        ]);
                })->make(true);
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

            $author = Author::all();

            $book = Book::all();

            $member = Role::where('name', 'member')->first()->users;

            $borrow = BorrowLog::all();

            return view('dashboard.admin', compact('author', 'book', 'member', 'borrow'));
        }

        return view('login');
    }
}
