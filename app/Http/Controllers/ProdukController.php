<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProdukModel;
use App\Models\ProdukModel;

class ProdukController extends Controller
{
    public function index(){
        $produk = ProdukModel::all();
        return view('produk.index', compact("produk"));
    }

    public function create(){
        $kategoriProduk = KategoriProdukModel::all();
        return view('produk.create', compact("kategoriProduk"));
    }

    public function save(Request $request){
        $validate = $this->formValidate($request);
        $save = ProdukModel::create($validate);

        return redirect()->route("produk.index")->with('success', 'Produk berhasil disimpan');
    }

    public function edit($id){
        $produk = ProdukModel::find($id);
        $kategoriProduk = KategoriProdukModel::all();

        return view("produk.edit", compact("produk", "kategoriProduk"));
    }

    public function update(Request $request){
        $validate = $this->formValidate($request, "update");
        $update = ProdukModel::find($request->id)->update($validate);

        return redirect()->route("produk.index")->with('success', 'Produk berhasil diubah');
    }

    public function detail($id){
        $produk = ProdukModel::with("kategori")->find($id);
        
        return response()->json([
            'status' => $produk ? true : false,
            'data'   => $produk
        ]);
    }

    public function delete($id){
        $find = ProdukModel::find($id);
        $find->delete();

        return redirect()->route("produk.index")->with('success', 'Produk berhasil dihapus');
    }

    private function formValidate($request, $case = null)
    {
        $validate = null;
        switch ($case) {
            case 'update':
                $validate = $request->validate([
                    'nama_produk'           => 'required|string|max:255',
                    'kategori_produk_id'    => 'required|exists:kategori_produk,id',
                    'harga_beli'            => 'required|numeric|min:0',
                    'harga_jual'            => 'required|numeric|min:0',
                    'deskripsi'             => 'required|string',
                ]);
                break;
            
            default:
                $validate = $request->validate([
                    'nama_produk'           => 'required|string|max:255',
                    'kategori_produk_id'    => 'required|exists:kategori_produk,id',
                    'harga_beli'            => 'required|numeric|min:0',
                    'harga_jual'            => 'required|numeric|min:0',
                    'stok'                  => 'required|integer|min:0',
                    'deskripsi'             => 'required|string',
                    // 'gambar'                => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
                ]);
                break;
        }

        return $validate;
    }

}
