<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tariff_types')->insert([[
            'name'          => 'First',
            'price'         => 2500,
            'delivery_days' => 6,
        ],
        [
            'name'          =>  'Second',
            'price'         => 4800,
            'delivery_days' => 12,
        ]]);
    }
}
