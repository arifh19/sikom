<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['midlleware' => 'web'], function() {

    // Auth
    Auth::routes();
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    // Index
    Route::get('/', 'HomeController@index');
    Route::get('/register/confirm', [
        'as' => 'register.confirm',
        'uses' => 'Auth\RegisterController@konfirmasi'
    ]);

    Route::get('/home', 'HomeController@index');
    Route::get('/register/dosen', 'Auth\RegisterDosenController@showRegistrationFormDosen');
    Route::post('/register/dosen', 'Auth\RegisterDosenController@register');

    //
    // Member
    //
    
    Route::group(['prefix' => 'mahasiswa', 'middleware' => ['auth', 'role:member']], function() {
        Route::resource('proposal', 'ProposalsController',[
            'except' => ['show','destroy']
        ]);
        Route::resource('team', 'TeamsController', [
            'except' => ['destroy']
        ]);
        Route::get('proposal/{proposal}/edit/success', [
            'as' => 'mahasiswa.proposals.edit',
            'uses' => 'ProposalsController@editproposal'
        ]);
        Route::get('proposal/{proposal}/edit/failed', [
            'as' => 'mahasiswa.proposals.edits',
            'uses' => 'ProposalsController@editgagal'
        ]);
    });

    //review proposal dosen index
    Route::get('dosen/proposals', [
        'middleware' => ['auth', 'role:dosen'],
        'as' => 'dosen.proposals.index',
        'uses' => 'ProposalsController@indexDosen'
    ]);
    Route::get('dosen/proposals/{proposal}', [
        'middleware' => ['auth', 'role:dosen'],
        'as' => 'dosen.proposals.show',
        'uses' => 'ProposalsController@show'
    ]);

    Route::group(['prefix' => 'dosen', 'middleware' => ['auth', 'role:dosen']], function() {
        Route::resource('komentars', 'KomentarsController', [
            'only' => ['show','store']
        ]);
    });

    //
    // Berlaku untuk Member & Admin
    //

    // Profile
    Route::get('settings/profile', 'SettingsController@profile');

    // Edit Profile
    Route::get('settings/profile/edit', 'SettingsController@editProfile');

    // Update Profile
    Route::post('settings/profile', 'SettingsController@updateProfile');

    // Ubah password
    Route::get('settings/password', 'SettingsController@editPassword');
    Route::post('settings/password', 'SettingsController@updatePassword');

    //
    // Aktiviasi & Verifikasi Email
    //

    // Kirim Email Verifikasi waktu Register
    Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');

    // Kirim Ulang email Verifikasi
    Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');

    // Admin
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function() {
        Route::resource('kategoris', 'KategorisController',[
            'only' => ['create','store','index']
        ]);
        Route::resource('teamz', 'TeamsController');
        Route::resource('proposalz', 'ProposalsController');
        Route::resource('userz', 'UsersController',[
            'except' => ['create','store']
        ]);
        Route::resource('komentarz', 'KomentarsController', [
            'only' => ['show','store']
        ]);
        Route::get('admin/userz/{userz}', [
            'as' => 'admin.userz.verify',
            'uses' => 'UsersController@verifikasi'
        ]);
        Route::get('admin/userv/{user}', [
            'as' => 'admin.userz.admin',
            'uses' => 'UsersController@ubahAdmin'
        ]);
        Route::get('admin/userw/{user}}', [
            'as' => 'admin.userz.staff',
            'uses' => 'UsersController@ubahStaff'
        ]);
        Route::get('admin/userx/{user}', [
            'as' => 'admin.userz.dosen',
            'uses' => 'UsersController@ubahDosen'
        ]);
        Route::get('admin/usery/{user}', [
            'as' => 'admin.userz.mahasiswa',
            'uses' => 'UsersController@ubahMahasiswa'
        ]);
    });
    Route::group(['prefix' => 'staff', 'middleware' => ['auth', 'role:staff']], function() {
        Route::resource('proposals', 'ProposalsController');
        Route::resource('komentars', 'KomentarsController');
        Route::resource('teams', 'TeamsController');
        // Route::resource('users', 'UsersController',[
        //     'except' => ['create','store','destroy']
        // ]);
    });
});
