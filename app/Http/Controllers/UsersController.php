<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\RoleUser;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $users = Auth::user()->where('id','!=', Auth::user()->id)->get();

            return Datatables::of($users)
                ->addColumn('action', function($user) {
                    return view('datatable._actionUser', [
                        'model'             => $user,
                        'form_url'          => route('userz.destroy', $user->id),
                        'edit_url'          => route('userz.edit', $user->id),
                        'blok_url'          => route('admin.userz.verify', $user->id),
                        'verify_url'          => route('admin.userz.verify', $user->id),
                        'admin_url'          => route('admin.userz.admin', $user->id),
                        'staff_url'          => route('admin.userz.staff', $user->id),
                        'dosen_url'          => route('admin.userz.dosen', $user->id),
                        'mahasiswa_url'          => route('admin.userz.mahasiswa', $user->id),
                        'confirm_message'    => 'Yakin mau menghapus ' . $user->name . '?'
                    ]);
                })
                ->addColumn('role', function($user) {
                    return view('datatable._role', [
                        'model'             => $user,
                        'roles'             => RoleUser::where('user_id',$user->id)->first(),
                    ]);
                })
                ->addColumn('status', function($user) {
                    return view('datatable._status', [
                        'model'             => $user,
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])  
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
            ->addColumn(['data' => 'role', 'name' => 'role', 'title' => 'Role'])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status']);
            
        return view('users.index')->with(compact('html'));
    }

    public function verifikasi($id){
        $user = Auth::user()->findOrfail($id);
        if($user->is_verified==1){
            $user->is_verified=0;
            $user->save();
        }
        elseif($user->is_verified==0){
            $user->is_verified=1;
            $user->save();
        }
        return redirect()->route('userz.index');
    }

    public function ubahAdmin($id){
        $role = RoleUser::where('user_id',$id)->first();
        $role->role_id = 1;
        $role->save();
        return redirect()->route('userz.index');
    }
    public function ubahMahasiswa($id){
        $role = RoleUser::where('user_id',$id)->first();
        $role->role_id = 2;
        $role->save();
        return redirect()->route('userz.index');
    }
    public function ubahDosen($id){
        $role = RoleUser::where('user_id',$id)->first();
        $role->role_id = 3;
        $role->save();
        return redirect()->route('userz.index');
    }
    public function ubahStaff($id){
        $role = RoleUser::where('user_id',$id)->first();
        $role->role_id = 4;
        $role->save();
        return redirect()->route('userz.index');
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
        //
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
        $user = Auth::user()->findOrfail($id);
        return view('users.edit')->with(compact('user'));
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Nama masih kosong',
            'email.required' => 'Email masih kosong',
            'password.required' => 'Password tidak ada',
        ]);

        $user = User::findOrfail($id);
        
        if(!$user->update($request->all())) return redirect()->back();

        // Isi field upload jika ada proposal yang diupload
        if ($request->hasFile('avatar')) {

            // Mengambil proposal yang diupload berikut ektensinya
            $filename = null;
            $uploaded_avatar = $request->file('avatar');
            $extension = $uploaded_avatar->getClientOriginalExtension();

            // Membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;

            // Menyimpan proposal ke folder public/avatar
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded_avatar->move($destinationPath, $filename);

            // Hapus user lama, jika ada
            if ($user->avatar) {
                $old_upload = $user->avatar;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $user->avatar;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }

            // Ganti field proposal dengan user yang baru
            $user->avatar = $filename;   
        }
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Berhasil menyimpan $user->name"
        ]);
        return redirect()->route('userz.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = Auth::user()->find($id);

        $avatar = $user->avatar;

        if (!$user->delete()) return redirect()->back();

        // Handle hapus avatar via ajax
        if ($request->ajax()) return response()->json(['id' => $id]);

        // Hapus avatar lama, jika ada
        if ($avatar) {

            $old_avatar = $user->avatar;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $user->avatar;

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

        return redirect()->route('userz.index');
    }
}
