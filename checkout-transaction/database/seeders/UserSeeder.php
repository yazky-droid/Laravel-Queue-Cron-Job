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
        \DB::table('users')->insert([
            [
                'name' => 'Dina Fauziyah',
                'email' => 'emailproject070@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('kamukepo')
            ],

            [
                'name' => 'Muhammad Faris Fauzi',
                'email' => 'dfauziyah37@yahoo.com',
                'email_verified_at' => now(),
                'password' => bcrypt('rahasialah')
            ]

        ]);
    }
}
