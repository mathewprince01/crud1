<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name'=>'chennai','country_id'=>1],
            ['name'=>'mumbai','country_id'=>1],
            ['name'=>'trichy','country_id'=>1],
            ['name'=>'san_francis','country_id'=>2],
            ['name'=>'Baston','country_id'=>2],
            ['name'=>'waishton','country_id'=>2]
        ]);
    }
}
