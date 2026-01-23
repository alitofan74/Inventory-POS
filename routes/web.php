<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KategoriProdukController,
    ProdukController
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

// route of navbar profile
Route::view('/profil', 'profile.index')->name("profile");
Route::view('/aktivitas-akun', 'profile.aktivitas-akun')->name("aktivitasakun");
Route::view('/pengaturan', 'profile.pengaturan')->name("pengaturan");


// end of route navbar profile

// route of main
Route::get('/', [DashboardController::class, "index"])->name("dashboard");
Route::view('/penjualan', 'main.penjualan')->name('penjualan');
Route::view('/update-stok', 'main.update-stok')->name('updatestok');
Route::view('/marketplace', 'main.marketplace')->name('marketplace');
Route::view('/kondisi-inventaris', 'main.kondisi-inventaris')->name('kondisiinventaris');

// end of route main



//route of master menu
Route::prefix("produk")->name("produk.")->group(function(){
    Route::get("/", [ProdukController::class, "index"])->name("index");
    Route::get("/baru", [ProdukController::class, "create"])->name("create");
    Route::post("/simpan", [ProdukController::class, "save"])->name("save");
    Route::get("/edit/{id}", [ProdukController::class, "edit"])->name("edit");
    Route::post("/update", [ProdukController::class, "update"])->name("update");
    Route::get("/detail/{id}", [ProdukController::class, "detail"])->name("detail");
    Route::get("/delete/{id}", [ProdukController::class, "delete"])->name("delete");
});


Route::prefix("kategori-produk")->name("kategoriproduk.")->group(function(){
    Route::get('/', [KategoriProdukController::class, "index"])->name("index");
    Route::get('/baru', [KategoriProdukController::class, "createKategori"])->name("createkategori");
    Route::post('/simpan', [KategoriProdukController::class, "saveKategori"])->name("savekategori");
    Route::get('/edit/{id}', [KategoriProdukController::class, "editKategori"])->name("edit");
    Route::post('/update', [KategoriProdukController::class, "updateKategori"])->name("update");
    Route::get('/delete/{id}', [KategoriProdukController::class, "deleteKategori"])->name("delete");
});


Route::prefix("inventaris-toko")->name("inventaris.")->group(function(){
    Route::view('/', 'inventaris.index')->name('index');
});


Route::prefix("kategori-inventaris")->name("kategoriinv.")->group(function(){
    Route::view('/', 'kategoriinventaris.index')->name('index');
});


//end of route of master menu




// route of laporan
Route::prefix("laporan")->name("lap")->group(function(){
    Route::view('/penjualan', 'laporan.penjualan')->name('penjualan');
    Route::view('/produk-masuk', 'laporan.produk-masuk')->name('brgmasuk');
    Route::view('/kondisi-inventaris', 'laporan.kondisi-inventaris')->name('kondisiinv');
});

// end of route laporan


