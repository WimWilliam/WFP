<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Kalo DB ERROR
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 6; $i++) { 
            DB::table('products')->insert([
                'name' => Str::random(10),
                'deskripsi' => Str::random(20),
                'type_product' => rand(1, 5),
                'hotel_id' => rand(1, 5),
            ]);
        }
    }
}
