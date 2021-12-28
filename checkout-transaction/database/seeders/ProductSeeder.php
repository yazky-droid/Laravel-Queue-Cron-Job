<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert([
            [
                'name' => 'Selamat Tinggal (Tere Liye) (SBS)',
                'price' => 68000,
                'stock' => 2
            ],

            [
                'name' => 'The Secret of Red Sky by Jung Eun Gwol',
                'price' => 139000,
                'stock' => 27
            ],

            [
                'name' => 'The Secret of Red Sky by Jung Eun Gwol',
                'price' => 139000,
                'stock' => 20
            ],

            [
                'name' => 'Why Secretary Kim 2 by Jeong Gyeong Yun',
                'price' => 53000,
                'stock' => 50
            ],

            [
                'name' => 'Aku Bukannya Menyerah, Hanya Sedang Lelah',
                'price' => 77000,
                'stock' => 3
            ]
        ]);
    }
}
