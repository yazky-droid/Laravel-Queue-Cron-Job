<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Melon',
                'price' => 7000,
                'product_image_name' => 'null',
                'product_image_url' => 'null',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Semangka',
                'price' => 5000,
                'product_image_name' => 'null',
                'product_image_url' => 'null',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jeruk',
                'price' => 9000,
                'product_image_name' => 'null',
                'product_image_url' => 'null',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('products')->insert($data);
    }
}
