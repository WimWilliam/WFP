<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


//Kalo DB ERROR
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypesProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('typesproducts')->insert([
            ['name' => 'Regular'],
            ['name' => 'Superior'],
            ['name' => 'VIP'],
            ['name' => 'President Suite'],
            ['name' => 'Transit'],
        ]);
    }
}
