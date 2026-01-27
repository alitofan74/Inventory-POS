<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangMasukSeeder extends Seeder
{
    public function run(): void
    {
        $keterangan = [
            'Pembelian supplier',
            'Restock gudang pusat',
            'Barang retur',
            'Bonus supplier',
            'Stok tambahan',
            'Pembelian mendadak'
        ];

        for ($i = 1; $i <= 20; $i++) {
            $produkId = rand(1, 6);
            $jumlahMasuk = rand(1, 50);
            DB::table('barang_masuk')->insert([
                'tanggal_masuk' => Carbon::now()->subDays(rand(0, 30)),
                'produk_id'     => $produkId,
                'jumlah_masuk'  => $jumlahMasuk,
                'keterangan'    => $keterangan[array_rand($keterangan)],
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // UPDATE STOK PRODUK
            DB::table('produk')
                ->where('id', $produkId)
                ->increment('stok', $jumlahMasuk);
        }
    }
}
