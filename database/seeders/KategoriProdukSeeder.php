<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('kategori_produk')->insert([
            [
                'nama_kategori' => 'Komputer & Laptop',
                'deskripsi'     => 'PC rakitan, laptop baru/second, dan all-in-one PC',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nama_kategori' => 'Komponen PC',
                'deskripsi'     => 'Processor, motherboard, RAM, storage, VGA, PSU, casing, dan cooling',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nama_kategori' => 'Perangkat Input',
                'deskripsi'     => 'Keyboard, mouse, mousepad, dan perangkat input lainnya',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nama_kategori' => 'Perangkat Output',
                'deskripsi'     => 'Monitor, printer, speaker, headset, dan perangkat output lainnya',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nama_kategori' => 'Aksesoris Komputer',
                'deskripsi'     => 'Kabel, USB hub, webcam, card reader, dan aksesoris pendukung',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nama_kategori' => 'Jaringan & Internet',
                'deskripsi'     => 'Router, modem, switch, LAN card, dan perangkat jaringan',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ]);
    }
}
