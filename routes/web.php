<?php

use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\Maps2Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\UsulanController;
use App\Models\managementUser;

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



    // return view('maps/sidebar');
    Route::get('/view', [Maps2Controller::class,'view' ])->name('view');
    Route::get('/template', [Maps2Controller::class,'template' ])->name('template');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'auto_login'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [MapsController::class,'smartmap' ])->name('smartmap');

    Route::resource('/maps', \App\Http\Controllers\MapsController::class);
    Route::resource('/muser', \App\Http\Controllers\ManagementUserController::class);
    Route::resource('/usulan', \App\Http\Controllers\UsulanController::class);
    // Route::get('/users', 'UserController@index');
    // Route::resource('/nop', \App\Http\Controllers\MapsController::class);
    Route::get('/getSearchNop/{slug}', [MapsController::class,'getSearchNop' ])->name('getSearchNop');
    Route::get('/getAllNop', [MapsController::class,'getAllNop' ])->name('getAllNop');
    Route::get('/getNop/{kec}/{kel}', [MapsController::class,'getNop' ])->name('getNop');
    Route::get('/getBlok/{kec}/{kel}', [MapsController::class,'getBlok' ])->name('getBlok');
    Route::get('/getBng/{kec}/{kel}', [MapsController::class,'getBng' ])->name('getBng');
    Route::get('/masuk', [MapsController::class,'masuk' ])->name('masuk');
    Route::get('/getWilayah', [MapsController::class,'getWIlayah' ])->name('getWilayah');
    Route::get('/getDesa/{kec}', [MapsController::class,'getDesa' ])->name('getDesa');
    Route::get('/getPrintPeta/{kel}', [MapsController::class,'getPrintPeta' ])->name('getPrintPeta');
    Route::get('/smartmap', [MapsController::class,'smartmap' ])->name('smartmap');
    Route::post('/save_nop', [MapsController::class,'save_nop' ])->name('save_nop');
    Route::get('/', function () {
        // return view('welcome');
        return redirect()->route('login');
    });
    

    


    //tematik
    Route::post('/jenis_tanah', [MapsController::class,'jenis_tanah' ])->name('jenis_tanah');
    Route::post('/jenis_penggunaan_bangunan', [MapsController::class,'jenis_penggunaan_bangunan' ])->name('jenis_penggunaan_bangunan');
    Route::post('/nilai_individu', [MapsController::class,'nilai_individu' ])->name('nilai_individu');
    Route::post('/npwp', [MapsController::class,'npwp' ])->name('npwp');
    Route::post('/nik', [MapsController::class,'nik' ])->name('nik');
    Route::post('/kelas_tanah', [MapsController::class,'kelas_tanah' ])->name('kelas_tanah');
    Route::post('/kelas_bangunan', [MapsController::class,'kelas_bangunan' ])->name('kelas_bangunan');
    Route::post('/znt', [MapsController::class,'znt' ])->name('znt');
    Route::post('/buku', [MapsController::class,'buku' ])->name('buku');
    Route::post('/status_pembayaran', [MapsController::class,'status_pembayaran' ])->name('status_pembayaran');
    Route::post('/getTematik', [MapsController::class,'getTematik' ])->name('getTematik');
    Route::post('/informasiOP', [MapsController::class,'informasiOP' ])->name('informasiOP');

    Route::get('/getUsers', [ManagementUserController::class,'getUsers' ])->name('getUsers');
    Route::get('/getUsulan', [UsulanController::class,'getUsulan' ])->name('getUsulan');
    Route::get('/nonaktifkanUsulan/{id}', [UsulanController::class,'nonaktifkanUsulan' ])->name('nonaktifkanUsulan');
    // Route::post('/muser/{id}', [ManagementUserController::class,'update' ])->name('muser.update');
    Route::post('/save_usulan', [UsulanController::class,'save_usulan' ])->name('save_usulan');

    Route::delete('/deleteNop/{id}', [MapsController::class, 'deleteNop'])->name('nop.delete');
    Route::delete('/deleteBlok/{id}', [MapsController::class, 'deleteBlok'])->name('blok.delete');
    Route::delete('/deleteBangunan/{id}', [MapsController::class, 'deleteBangunan'])->name('bangunan.delete');
    Route::post('/ins_nop', [MapsController::class,'isn_nop' ])->name('nop.ins');
    Route::post('/ins_blok', [MapsController::class,'isn_blok' ])->name('blok.ins');
    Route::post('/ins_bangunan', [MapsController::class,'isn_bangunan' ])->name('bangunan.ins');

});
