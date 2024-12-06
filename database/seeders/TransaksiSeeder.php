<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksi = [
            [
                'judul' => 'Gaji Kerja',
                'kategori' => 'Lainnya',
                'nominal' => '10000000',
                'metode' => 'BCA',
                'tipe' => 'Pemasukan',
                'tanggal_transaksi' => '2024-9-1',
                'user_id' => 1
            ],
            [
                'judul' => 'Gaji Kerja',
                'kategori' => 'Lainnya',
                'nominal' => '5000000',
                'metode' => 'Cash',
                'tipe' => 'Pemasukan',
                'tanggal_transaksi' => '2024-9-1',
                'user_id' => 1
            ],
            [
                'judul' => '7 Speed Cafe',
                'kategori' => 'Makan',
                'nominal' => '15000',
                'metode' => 'Cash',
                'tipe' => 'Pengeluaran',
                'tanggal_transaksi' => '2024-10-21',
                'user_id' => 1
            ],
            [
                'judul' => 'Bitcoin',
                'kategori' => 'Investasi',
                'nominal' => '200000',
                'metode' => 'BCA',
                'tipe' => 'Pengeluaran',
                'tanggal_transaksi' => '2024-10-21',
                'user_id' => 1
            ],
            [
                'judul' => 'Beli Bensin',
                'kategori' => 'Utilitas',
                'nominal' => '150000',
                'metode' => 'Cash',
                'tipe' => 'Pengeluaran',
                'tanggal_transaksi' => '2024-10-21',
                'user_id' => 1
            ],
            [
                'judul' => 'Jual Akun ML',
                'kategori' => 'Entertainment',
                'nominal' => '100000',
                'metode' => 'BCA',
                'tipe' => 'Pemasukan',
                'tanggal_transaksi' => '2024-10-21',
                'user_id' => 1
            ],
            [
                'judul' => 'Gaji Kerja',
                'kategori' => 'Lainnya',
                'nominal' => '5000000',
                'metode' => 'Cash',
                'tipe' => 'Pemasukan',
                'tanggal_transaksi' => '2024-9-1',
                'user_id' => 2
            ],
            [
                'judul' => 'AA Cafe',
                'kategori' => 'Makan',
                'nominal' => '20000',
                'metode' => 'Cash',
                'tipe' => 'Pengeluaran',
                'tanggal_transaksi' => '2024-10-21',
                'user_id' => 2
            ],
            [
                'judul' => 'Beli Baju',
                'kategori' => 'Utilitas',
                'nominal' => '130000',
                'metode' => 'Cash',
                'tipe' => 'Pengeluaran',
                'tanggal_transaksi' => '2024-10-21',
                'user_id' => 2
            ],
        ];

        DB::table('transaksi')->insert($transaksi);
    }
}
