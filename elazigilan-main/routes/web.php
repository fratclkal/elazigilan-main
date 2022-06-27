<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelController;
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

Route::get('/', [HomeController::class, 'index'])->name('front.index');
Route::get('/order/{order}', [HomeController::class, 'index'])->name('front.index.order');

Route::get('/search', [HomeController::class, 'search'])->name('front.search');

Route::get('/ad/{ilan}', [HomeController::class, 'detail'])->name('front.single.ad');

Route::get('/file/{file_id}', function ($file_id) {
    return response()->file(public_path() . '/contentFiles/' . \App\Models\File::find($file_id)->path);
})->name('content.show.file');

Route::group(['prefix' => 'panel', 'middleware' => 'admin'], function (){
    Route::get('/', [PanelController::class, 'index'])->name('panel.index');
    Route::get('/ad/add', [PanelController::class, 'addAd'])->name('panel.add.ad');

    Route::group(['prefix' => 'settings'], function (){
        Route::get('/', [PanelController::class, 'settings_index'])->name('panel.settings.index');
        Route::post('/settings-post', [PanelController::class, 'settings_update'])->name('panel.settings.update');
    });


    Route::group(['prefix' => 'ad'], function () {
        Route::get('/', [PanelController::class, 'index'])->name('panel.ads.index');
        Route::get('/fetch', [PanelController::class, 'adsFetch'])->name('panel.ads.fetch');
        Route::post('/create', [PanelController::class, 'create'])->name('panel.ads.create');
        Route::post('/delete', [PanelController::class, 'delete'])->name('panel.ads.delete');
        Route::post('/get', [PanelController::class, 'get'])->name('panel.ads.get');
        Route::post('/update', [PanelController::class, 'update'])->name('panel.ads.update');
        Route::get('/update_active', [PanelController::class, 'update_active'])->name('panel.ads.update_active');
    });


});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('panel.index');
})->name('dashboard');
