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

    public function saveKategori(Request $request){
        $validate = $this->formValidate($request);
        $save = KategoriProdukModel::create($validate);

        return redirect()->route("kategoriproduk.index")->with('success', 'Kategori produk berhasil disimpan');
    }

    public function editKategori($id){
        $kategoriProduk = KategoriProdukModel::find($id);
        return view("kategoriproduk.update-kategoriproduk", compact("kategoriProduk"));
    }

    public function updateKategori(Request $request){
        $validate = $this->formValidate($request);
        $data = KategoriProdukModel::find($request->id);
        $data->update($validate);

        return redirect()->route("kategoriproduk.index")->with('success', 'Kategori produk berhasil diubah');
    }

    public function deleteKategori($id){
        $find = KategoriProdukModel::find($id);
        $find->delete();

        return redirect()->route("kategoriproduk.index")->with('success', 'Kategori produk berhasil dihapus');
    }

    private function formValidate($request){
        return $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
        ]);
    }
}
