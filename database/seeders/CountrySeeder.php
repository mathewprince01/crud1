<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('countries')->insert([
        ['id'=>1,'name'=>'india'],
        ['id'=>2,'name'=>'USA'],
    ]);
    }
}
