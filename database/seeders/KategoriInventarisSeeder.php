<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('kategori_inventaris')->insert([
            [
                'nama_kategori' => 'Hardware',
                'deskripsi' => 'Perangkat keras IT seperti komputer, laptop, server, dan printer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_kategori' => 'Software',
                'deskripsi' => 'Perangkat lunak seperti sistem operasi, aplikasi, dan lisensi software',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_kategori' => 'Jaringan',
                'deskripsi' => 'Perangkat jaringan seperti router, switch, access point, dan kabel LAN',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_kategori' => 'Periferal',
                'deskripsi' => 'Perangkat pendukung seperti keyboard, mouse, headset, dan webcam',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_kategori' => 'Server & Data Center',
                'deskripsi' => 'Perangkat server, rack server, UPS, dan storage data',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_kategori' => 'Keamanan IT',
                'deskripsi' => 'Perangkat keamanan seperti CCTV, firewall, dan sistem keamanan jaringan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
