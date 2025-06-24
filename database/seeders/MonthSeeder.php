<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            ['name' => 'Januari'],
            ['name' => 'Februari'],
            ['name' => 'Maret'],
            ['name' => 'April'],
            ['name' => 'Mei'],
            ['name' => 'Juni'],
            ['name' => 'Juli'],
            ['name' => 'Agustus'],
            ['name' => 'September'],
            ['name' => 'Oktober'],
            ['name' => 'November'],
            ['name' => 'Desember'],
        ];

        DB::table('months')->insert($months);
    }
}
