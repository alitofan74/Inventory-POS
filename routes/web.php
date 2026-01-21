<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KategoriProdukController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, "index"])->name("dashboard");

//route of master menu
Route::prefix("kategori-produk")->name("kategoriproduk.")->group(function(){
    Route::get('/', [KategoriProdukController::class, "index"])->name("index");
    Route::get('/baru', [KategoriProdukController::class, "createKategori"])->name("createkategori");
    Route::post('/simpan', [KategoriProdukController::class, "saveKategori"])->name("savekategori");
    Route::get('/edit/{id}', [KategoriProdukController::class, "editKategori"])->name("edit");
    Route::post('/update', [KategoriProdukController::class, "updateKategori"])->name("update");
    Route::get('/delete/{id}', [KategoriProdukController::class, "deleteKategori"])->name("delete");
});

//end of route of master menu


