<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisModel;
use App\Models\KategoriInventarisModel;
use Illuminate\Support\Facades\Storage;

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

        $uploadImageRoute = route("inventaris.upload-gambar", $save->id);
        return response()->json([
            'success'               => $save ? true : false,
            'uploadImageRoute'      => $save ? $uploadImageRoute : [],
            'backRoute'             => route("inventaris.index")
        ]);
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


    public function uploadGambar($id){
        $inventaris = InventarisModel::with("kategori")->find($id);

        return view("inventaris.gambar-inventaris", compact("inventaris"));
    }

    public function simpanGambar(Request $request){
        $validate = $this->formValidate($request, "upload-image");
        $inventaris = InventarisModel::find($request->id);

        if ($inventaris->gambar && Storage::disk('public')->exists($inventaris->gambar)) {
            Storage::disk('public')->delete($inventaris->gambar);
        }

        $path = $request->file('gambar')->store('inventaris', 'public');

        $inventaris->gambar = $path;
        $inventaris->save();

        return redirect()->route("inventaris.upload-gambar", $inventaris->id)->with("success", "Gambar inventaris Toko berhasil di upload");
    }


    private function formValidate($request, $case = null)
    {
        switch ($case) {
            case 'upload-image':
                return $request->validate([
                    'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
                ]);

            default:
                return $request->validate([
                    'nama_inventaris' => 'required|string|max:255',
                    'kategori_inventaris_id' => 'required|exists:kategori_inventaris,id',
                    'deskripsi' => 'required|string',
                ]);
        }
    }


}
