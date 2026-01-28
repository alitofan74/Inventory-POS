<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KategoriProdukController,
    ProdukController,
    KategoriInventarisController,
    InventarisController,
    BarangMasukController,
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

Route::get('/barang-masuk', [BarangMasukController::class, "index"])->name("barangmasuk");
Route::post('/barang-masuk/simpan', [BarangMasukController::class, "savebrgmasuk"])->name("savebarangmasuk");
Route::get('/ajax/barang-masuk/{id}', [BarangMasukController::class, 'ajaxBarangMasuk']);

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
    Route::get("/upload-gambar/{id}", [ProdukController::class, "uploadGambar"])->name("upload-gambar");
    Route::post("/simpan-gambar", [ProdukController::class, "simpanGambar"])->name("simpan-gambar");
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
    Route::get('/', [InventarisController::class, "index"])->name('index');
    Route::get('/baru', [InventarisController::class, "createinventaris"])->name('createinventaris');
    Route::post('/simpan', [InventarisController::class, "saveinventaris"])->name("saveinventaris");
    Route::get('/edit/{id}', [InventarisController::class, "editinventaris"])->name('editinventaris');
    Route::post('/update', [InventarisController::class, "updateinventaris"])->name("updateinventaris");
    Route::get("/detail/{id}", [InventarisController::class, "detailinventaris"])->name("detailinventaris");
    Route::get('/delete/{id}', [InventarisController::class, "deleteinventaris"])->name("deleteinventaris");
    Route::get("/upload-gambar/{id}", [InventarisController::class, "uploadGambar"])->name("upload-gambar");
    Route::post("/simpan-gambar", [InventarisController::class, "simpanGambar"])->name("simpan-gambar");
});


Route::prefix("kategori-inventaris")->name("kategoriinv.")->group(function(){
    Route::get('/', [KategoriInventarisController::class, "index"])->name('index');
    Route::get('/baru', [KategoriInventarisController::class, "createkategori"])->name('createkategori');
    Route::post('/simpan', [KategoriInventarisController::class, "savekategori"])->name("savekategori");
    Route::get('/edit/{id}', [KategoriInventarisController::class, "editkategori"])->name('editkategori');
    Route::post('/update', [KategoriInventarisController::class, "updateKategori"])->name("updatekategori");
    Route::get('/delete/{id}', [KategoriInventarisController::class, "deletekategori"])->name("deletekategori");
});


//end of route of master menu




// route of laporan
Route::prefix("laporan")->name("lap")->group(function(){
    Route::view('/penjualan', 'laporan.penjualan')->name('penjualan');
    Route::view('/produk-masuk', 'laporan.produk-masuk')->name('brgmasuk');
    Route::view('/kondisi-inventaris', 'laporan.kondisi-inventaris')->name('kondisiinv');
});

// end of route laporan


