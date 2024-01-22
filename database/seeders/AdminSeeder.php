<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'madelines@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
                'no_hp' => '11223344',
                'referal' => '20240119',
                'status_akun' => 'Admin',
            ]
        ]);
    }
}
