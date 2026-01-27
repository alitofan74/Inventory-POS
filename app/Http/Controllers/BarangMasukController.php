<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;
use App\Models\BarangMasukModel;

class BarangMasukController extends Controller
{
    public function index(Request $request){
        $produk = ProdukModel::all();
        $data = BarangMasukModel::with('produk');

        if ($request->produk_id) {
            $data->where('produk_id', $request->produk_id);
        }

        $data->orderBy('tanggal_masuk', 'desc');

        $brgmasuk = $data->get();
        return view('main.barang-masuk',compact('produk','brgmasuk'));
    }

    public function savebrgmasuk(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'jumlah_masuk' => 'required|numeric'
        ]);

        BarangMasukModel::create([
            'tanggal_masuk' => now(),
            'produk_id' => $request->produk_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'keterangan' => $request->keterangan
        ]);

        ProdukModel::where('id', $request->produk_id)
            ->increment('stok', $request->jumlah_masuk);

        return redirect()->route("barangmasuk")->with('success', 'Barang masuk berhasil disimpan');
    }

}
