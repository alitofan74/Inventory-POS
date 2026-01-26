<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Ambil semua kategori (id)
        $kategoriIds = DB::table('kategori_produk')->pluck('id')->toArray();

        $produkSamples = [
            'Laptop Asus Vivobook',
            'Laptop Lenovo ThinkPad',
            'PC Rakitan Gaming',
            'Intel Core i5 Processor',
            'AMD Ryzen 7 Processor',
            'Motherboard ASUS B550',
            'RAM DDR4 16GB',
            'SSD NVMe 1TB',
            'VGA RTX 3060',
            'Power Supply 650W',
            'Mechanical Keyboard',
            'Wireless Mouse',
            'Gaming Headset',
            'Monitor 24 Inch',
            'Printer Inkjet',
            'USB Hub 7 Port',
            'Webcam Full HD',
            'LAN Card Gigabit',
            'Router WiFi 6',
            'Switch 8 Port',
        ];

        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $hargaBeli = rand(500_000, 15_000_000);
            $hargaJual = $hargaBeli + rand(100_000, 2_000_000);

            $data[] = [
                'nama_produk'        => $produkSamples[array_rand($produkSamples)] . " #$i",
                'harga_beli'         => $hargaBeli,
                'harga_jual'         => $hargaJual,
                'stok'               => rand(0, 50),
                'gambar'             => null, // nanti bisa diisi path gambar
                'deskripsi'          => 'Produk berkualitas dan bergaransi resmi.',
                'kategori_produk_id' => $kategoriIds[array_rand($kategoriIds)],
                'created_at'         => $now,
                'updated_at'         => $now,
            ];
        }

        DB::table('produk')->insert($data);
    }
}
