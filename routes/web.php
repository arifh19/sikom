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

    Route::get('/home', 'HomeController@index');
    Route::get('/register/dosen', 'Auth\RegisterDosenController@showRegistrationFormDosen');
    Route::post('/register/dosen', 'Auth\RegisterDosenController@register');

    //
    // Member
    //
    
    Route::group(['prefix' => 'mahasiswa', 'middleware' => ['auth', 'role:member']], function() {
        Route::resource('proposals', 'ProposalsController', [
        ]);
        Route::resource('teams', 'TeamsController', [
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
       // Route::resource('authors', 'AuthorsController');
        Route::resource('kategoris', 'KategorisController');
        //Route::resource('proposals', 'ProposalsController');
      //  Route::resource('books', 'BooksController');
      //  Route::resource('members', 'MembersController', [
      //      'only' => ['index', 'show', 'destroy']
      //  ]);

        // Daftar peminjaman
        // Route::get('statistics', [
        //     'as' => 'statistics.index',
        //     'uses' => 'StatisticsController@index'
        // ]);

        
    });
});
