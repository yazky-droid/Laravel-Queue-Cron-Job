<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'name' => 'Edward Cullen',
                'email' => 'edward@cullen.com',
                'password' => \Hash::make('edward'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Isabella Swan',
                'email' => 'isabella@swan.com',
                'password' => \Hash::make('isabella'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Renesmee Cullen',
                'email' => 'renesmee@cullen.com',
                'password' => \Hash::make('renesmee'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        \DB::table('users')->insert($data);
    }
}
