<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'client'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(['prefix' => 'layanan'], function () {
            Route::get('/index', [App\Http\Controllers\LayananController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\LayananController::class, 'data']);
        });

        Route::group(['prefix' => 'pemesanan'], function () {
            Route::get('/index', [App\Http\Controllers\PemesananController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\PemesananController::class, 'data']);
            Route::get('/create', [App\Http\Controllers\PemesananController::class, 'create']);
            Route::post('/store', [App\Http\Controllers\PemesananController::class, 'store']);
            Route::get('/edit/{id}', [App\Http\Controllers\PemesananController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\PemesananController::class, 'update']);
            Route::get('/delete/{id}', [App\Http\Controllers\PemesananController::class, 'delete']);
            Route::get('/jadwal/{id}', [App\Http\Controllers\JadwalController::class, 'checkjadwal']);
        });

        Route::group(['prefix' => 'history'], function () {
            Route::get('/index', [App\Http\Controllers\HistoryController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\HistoryController::class, 'data']);
            Route::get('/edit/{id}', [App\Http\Controllers\PemeriksaanController::class, 'instruktur_edit']);
            Route::post('/rating', [App\Http\Controllers\RatingController::class, 'client_rating']);
        });
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');

        Route::group(['prefix' => 'client'], function () {
            Route::get('/index', [App\Http\Controllers\ClientController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\ClientController::class, 'data']);
            Route::post('/create', [App\Http\Controllers\ClientController::class, 'create']);
            Route::get('/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\ClientController::class, 'update']);
            Route::get('/delete/{id}', [App\Http\Controllers\ClientController::class, 'delete']);
        });

        Route::group(['prefix' => 'instruktur'], function () {
            Route::get('/index', [App\Http\Controllers\InstrukturController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\InstrukturController::class, 'data']);
            Route::post('/create', [App\Http\Controllers\InstrukturController::class, 'create']);
            Route::get('/edit/{id}', [App\Http\Controllers\InstrukturController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\InstrukturController::class, 'update']);
            Route::get('/delete/{id}', [App\Http\Controllers\InstrukturController::class, 'delete']);
        });

        Route::group(['prefix' => 'layanan'], function () {
            Route::get('/index', [App\Http\Controllers\LayananController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\LayananController::class, 'data']);
            Route::post('/create', [App\Http\Controllers\LayananController::class, 'create']);
            Route::get('/edit/{id}', [App\Http\Controllers\LayananController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\LayananController::class, 'update']);
            Route::get('/delete/{id}', [App\Http\Controllers\LayananController::class, 'delete']);
        });

        Route::group(['prefix' => 'diskon'], function () {
            Route::get('/index', [App\Http\Controllers\DiskonController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\DiskonController::class, 'data']);
            Route::post('/create', [App\Http\Controllers\DiskonController::class, 'create']);
            Route::get('/edit/{id}', [App\Http\Controllers\DiskonController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\DiskonController::class, 'update']);
            Route::get('/delete/{id}', [App\Http\Controllers\DiskonController::class, 'delete']);
        });

        Route::group(['prefix' => 'pemesanan'], function () {
            Route::get('/index', [App\Http\Controllers\PemesananController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\PemesananController::class, 'data']);
            Route::get('/create', [App\Http\Controllers\PemesananController::class, 'create']);
            Route::get('/jadwal/{id}', [App\Http\Controllers\JadwalController::class, 'checkjadwal']);
            Route::post('/store', [App\Http\Controllers\PemesananController::class, 'store']);
            Route::get('/edit/{id}', [App\Http\Controllers\PemesananController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\PemesananController::class, 'update']);
            Route::get('/delete/{id}', [App\Http\Controllers\PemesananController::class, 'delete']);
        });

        Route::group(['prefix' => 'pemeriksaan'], function () {
            Route::get('/index', [App\Http\Controllers\PemeriksaanController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\PemeriksaanController::class, 'data']);
            Route::get('/edit/{id}', [App\Http\Controllers\PemeriksaanController::class, 'edit']);
            Route::post('/create', [App\Http\Controllers\PemeriksaanController::class, 'create']);
        });

        Route::group(['prefix' => 'jadwal'], function () {
            Route::get('/index', [App\Http\Controllers\JadwalController::class, 'index']);
            Route::get('/data', [App\Http\Controllers\JadwalController::class, 'data']);
        });

        // Route::group(['prefix' => 'history'], function () {
        //     Route::get('/index', [App\Http\Controllers\HistoryController::class, 'index']);
        //     Route::get('/data', [App\Http\Controllers\HistoryController::class, 'data']);
        // });

        Route::group(['prefix' => 'keuangan'], function () {
            Route::get('/index', [App\Http\Controllers\KeuanganController::class, 'index']);
            Route::get('/data/{id}/{id1}', [App\Http\Controllers\KeuanganController::class, 'data']);
        });

        Route::group(['prefix' => 'rating'], function () {
            Route::get('/index', [App\Http\Controllers\RatingController::class, 'index']);
            Route::get('/data/{id}/{id1}', [App\Http\Controllers\RatingController::class, 'data']);
        });
    });

    Route::group(['prefix' => 'instruktur'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'instrukturHome'])->name('instruktur.home');

        Route::group(['prefix' => 'pemeriksaan'], function () {
            Route::get('/index', [App\Http\Controllers\PemeriksaanController::class, 'instruktur_index']);
            Route::get('/data', [App\Http\Controllers\PemeriksaanController::class, 'instruktur_data']);
            Route::get('/edit/{id}', [App\Http\Controllers\PemeriksaanController::class, 'instruktur_edit']);
            Route::post('/update', [App\Http\Controllers\PemeriksaanController::class, 'instruktur_update']);
            Route::get('/selesai/{id}', [App\Http\Controllers\PemeriksaanController::class, 'instruktur_konfirmasi']);
        });

        Route::group(['prefix' => 'rating'], function () {
            Route::get('/index', [App\Http\Controllers\RatingController::class, 'index']);
        });
        
    });
});
Route::get('bukti/{id}', [App\Http\Controllers\PemesananController::class,'bukti']);
Route::get('hasil/{id}', [App\Http\Controllers\PemeriksaanController::class,'hasil']);
Route::get('invoice/{id}', [App\Http\Controllers\PemesananController::class,'invoice']);
Route::get('quotation/{id}', [App\Http\Controllers\PemesananController::class,'quotation']);
Route::get('kuitansi/{id}', [App\Http\Controllers\PemesananController::class,'kuitansi']);

Route::get('profile', [App\Http\Controllers\HomeController::class,'profile']);
Route::post('profile/update', [App\Http\Controllers\HomeController::class,'updateprofile']);

Route::get('grapik/admin', [App\Http\Controllers\KeuanganController::class,'grapik']);

Route::get('notifikasi', [App\Http\Controllers\HomeController::class,'notifikasi']);

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);