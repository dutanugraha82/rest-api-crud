<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'nama' => 'Toblerone',
                'jenis' => 'makanan',
                'expired' => '2024-01-01',
                'harga' => '25000'
            ],

            [
                'nama' => 'Red Bull',
                'jenis' => 'minuman',
                'expired' => '2024-01-01',
                'harga' => '20000'
            ]

        ];

        foreach ($products as $item) {
            Product::create([
                'nama' => $item['nama'],
                'jenis' => $item['jenis'],
                'expired' => $item['expired'],
                'harga' => $item['harga']
            ]);
        }
    }
}
