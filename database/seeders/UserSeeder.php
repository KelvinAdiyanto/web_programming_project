<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Zara',
                'role' => 'premium',
                'saldo_total' => '14735000',
                'tabungan_total' => '1750000000'
            ],
            [
                'nama' => 'Ari',
                'role' => 'regular',
                'saldo_total' => '4850000',
                'tabungan_total' => '30000000'
            ]
        ];

        DB::table('user')->insert($users);
    }
}
