<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualanModel;
use Illuminate\Http\Request;

use App\Models\ProdukModel;
use App\Models\PenjualanModel;

use App\Services\NotaService;

class PenjualanController extends Controller
{
    public function index(){
        return view("main.penjualan");
    }

    public function cancel(){
        $nota = session("nota");
        $delete = PenjualanModel::where("nota", $nota)->update(["status" => "cancel"]);
        return redirect()->route("penjualan.index");
    }

    public function getInvoice(){
        $findDrafted = PenjualanModel::draft()->first();
        if ($findDrafted) {
            $nota = $findDrafted->nota;
        }else{
            $nota = NotaService::generate();
            $save = PenjualanModel::create(["nota"  => $nota]);
        }
            
        session(["nota" => $nota]);
        return redirect()->route("penjualan.cashier");
    }

    public function cashier(){
        $nota = session("nota");
        $produk = ProdukModel::get();
        $penjualan = PenjualanModel::with("details.produk")
            ->where("nota", $nota)->first();

        return view("main.cashier", compact("produk", "nota", "penjualan"));
    }

    public function keranjang(Request $request){
        $produk = ProdukModel::findOrFail($request->txtproduk_id);
        $penjualan = PenjualanModel::where('nota', session("nota"))->firstOrFail();

        $detail = DetailPenjualanModel::where('penjualan_id', $penjualan->id)
            ->where('produk_id', $produk->id)
            ->first();
        
        if ($detail) {
            $detail->jumlah_jual += $request->jumlah_jual;
            $detail->save();
        } else {
            $detail = DetailPenjualanModel::create([
                "penjualan_id"  => $penjualan->id,
                "produk_id"     => $request->txtproduk_id,
                "jumlah_jual"   => $request->jumlah_jual,
                "harga_jual"    => $produk->harga_jual
            ]);
        }

        $penjualan->refresh();

        return response()->json([
            "status" => true,
            "data" => [
                "produk_id"     => $produk->id,
                "nama_produk"   => $produk->nama_produk,
                "harga"         => $detail->harga_jual_format,
                "jumlah_jual"   => $detail->jumlah_jual_format,
                "subtotal"      => $detail->subtotal_format,
                "grandtotal"    => $penjualan->grandtotal_format
            ]
        ]);
    }

    public function hapusItem($id){
        $detail = DetailPenjualanModel::findOrFail($id);
        $penjualan = PenjualanModel::findOrFail($detail->penjualan_id);

        $detail->delete();

        $penjualan->refreshTotal();

        return response()->json([
            'status' => true,
            'grandtotal' => $penjualan->grandtotal_format,
        ]);
    }
}
