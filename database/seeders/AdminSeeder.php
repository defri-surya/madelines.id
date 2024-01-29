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
                'name' => 'Perusahaan',
                'email' => 'madelines.id@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
                'no_hp' => '0811223344',
                'referal' => '202400002',
                'by_referal' => '202400001',
                'status_akun' => 'Admin',
            ]
        ]);

        DB::table('info_perusahaans')->insert([
            [
                'foto' => null,
                'nama' => 'MadeLines.id',
                'alamat' => 'Bantul',
                'cp' => '11223344',
                'no_cs_1' => '11223344',
                'no_cs_2' => '11223344',
                'no_cs_3' => '11223344',
            ]
        ]);
    }
}
