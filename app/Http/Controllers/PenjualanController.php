<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProdukModel;
use App\Models\PenjualanModel;

class PenjualanController extends Controller
{
    public function index(){
        $produk = ProdukModel::get();
        return view("main.penjualan", compact("produk"));
    }

    public function checkout(Request $request){
        $data = $request->all();
        $store = "";
        try {
            $store = PenjualanModel::create($data);
        } catch (\Exception $e) {
            return $e;
        }

        return $store;
    }
}
