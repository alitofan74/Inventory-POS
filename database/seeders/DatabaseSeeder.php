<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\InventarisSeeder;
use Database\Seeders\KategoriInventarisSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KategoriProdukSeeder::class,
            ProdukSeeder::class,
            KategoriInventarisSeeder::class,
            InventarisSeeder::class,
            BarangMasukSeeder::class,
        ]);
    }
}
