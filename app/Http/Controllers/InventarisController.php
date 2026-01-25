<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisModel;
use App\Models\KategoriInventarisModel;

class InventarisController extends Controller
{
    public function index(){
        $inventaris = InventarisModel::all();
        return view("inventaris.index-inventaris",compact('inventaris'));
    }

    public function createinventaris(){
        $kategoriInventaris = KategoriInventarisModel::all();
        return view('inventaris.create-inventaris', compact("kategoriInventaris"));
    }

    public function saveinventaris(Request $request){
        $validate = $this->formValidate($request);
        $save = InventarisModel::create($validate);

        return redirect()->route("inventaris.index")->with('success', 'Inventaris Toko berhasil disimpan');
    }

    public function editinventaris($id){
        $inventaris = InventarisModel::find($id);
        $kategoriInv = KategoriInventarisModel::all();

        return view("inventaris.update-inventaris", compact("inventaris", "kategoriInv"));
    }

    public function updateinventaris(Request $request){
        $validate = $this->formValidate($request);
        $update = InventarisModel::find($request->id)->update($validate);

        return redirect()->route("inventaris.index")->with('success', 'Inventaris Toko berhasil diubah');
    }

    public function detailinventaris($id){
        $inv = InventarisModel::with("kategori")->find($id);

        return response()->json([
            'status' => $inv ? true : false,
            'data'   => $inv
        ]);
    }

    public function deleteinventaris($id){
        $find = InventarisModel::find($id);
        $find->delete();

        return redirect()->route("inventaris.index")->with('success', 'Inventaris Toko berhasil dihapus');
    }

    private function formValidate($request){
        return $request->validate([
            'nama_inventaris'           => 'required|string|max:255',
            'kategori_inventaris_id'    => 'required|exists:kategori_inventaris,id',
            'deskripsi'             => 'required|string',
        ]);
    }

}
