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
        $data = [
            [
                'name' => 'Fox White Shirt',
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Woman blue skirt',
                'price' => 175000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basic blouse',
                'price' => 95500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        \DB::table('products')->insert($data);
    }
}
