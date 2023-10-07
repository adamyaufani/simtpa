<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('villages')->insert([
            'village_name' => 'Tamantirto'
        ]);
        DB::table('villages')->insert([
            'village_name' => 'Tirtonirmolo'
        ]);
        DB::table('villages')->insert([
            'village_name' => 'Ngestiharjo'
        ]);
        DB::table('villages')->insert([
            'village_name' => 'Bangunjiwo'
        ]);
    }
}
