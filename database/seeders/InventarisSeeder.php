<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = ['Laptop', 'PC', 'Printer', 'Scanner', 'Router', 'Monitor'];

        foreach ($barang as $b) {
            $kategoriId = DB::table('kategori_inventaris')->inRandomOrder()->value('id');

            DB::table('inventaris')->insert([
                'nama_inventaris' => $b,
                'deskripsi' => 'Barang dummy',
                'gambar' => strtolower($b) . '.jpg',
                'kategori_inventaris_id' => $kategoriId,
            ]);
        }
    }
}
