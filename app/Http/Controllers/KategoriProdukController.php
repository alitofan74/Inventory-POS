<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProdukModel;

class KategoriProdukController extends Controller
{
    public function index(){
        $kategoriProduk = KategoriProdukModel::all();
        return view("kategoriproduk.index-kategoriproduk", compact("kategoriProduk"));
    }

    public function createKategori(){
        return view("kategoriproduk.create-kategoriproduk");
    }
}
