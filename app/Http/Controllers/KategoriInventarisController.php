<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriInventarisModel;

class KategoriInventarisController extends Controller
{
    public function index(){
        $kategoriInventaris = KategoriInventarisModel::all();
        return view("kategoriinventaris.index-kategoriinventaris", compact("kategoriInventaris"));
    }

    private function formValidate($request){
        return $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
        ]);
    }

    public function createkategori(){
        return view('kategoriinventaris.create-kategoriinventaris');
    }

    public function savekategori(Request $request){
        $validate = $this->formValidate($request);
        $data = KategoriInventarisModel::create($validate);

        return redirect()->route('kategoriinv.index')->with('success', 'Kategori inventaris berhasil disimpan');
    }

    public function editkategori($id){
        $kategoriInventaris = KategoriInventarisModel::find($id);
        return view('kategoriinventaris.update-kategoriinventaris',compact('kategoriInventaris'));
    }

    public function updatekategori(Request $request){
        $validate = $this->formValidate($request);
        $data = KategoriInventarisModel::find($request->id);
        $data->update($validate);

        return redirect()->route('kategoriinv.index')->with('success', 'Kategori inventaris berhasil diubah');
    }

    public function deletekategori($id){
        $inv = KategoriInventarisModel::find($id);
        $inv->delete();

        return redirect()->route("kategoriinv.index")->with('success', 'Kategori inventaris berhasil dihapus');
    }
}
