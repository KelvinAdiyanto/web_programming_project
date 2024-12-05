<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tabungan = [
            [
                'judul' => 'Rumah',
                'nominal' => '100000000',
                'user_id' => 1,
            ],
            [
                'judul' => 'Mobil',
                'nominal' => '25000000',
                'user_id' => 1,
            ],
            [
                'judul' => 'Nikah',
                'nominal' => '25000000',
                'user_id' => 1,
            ],
            [
                'judul' => 'Mobil',
                'nominal' => '25000000',
                'user_id' => 2,
            ],
            [
                'judul' => 'Darurat',
                'nominal' => '5000000',
                'user_id' => 2,
            ]
        ];

        DB::table('tabungan')->insert($tabungan);
    }
}
