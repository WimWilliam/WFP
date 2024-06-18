<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Kalo DB ERROR
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 6; $i++) { 
            DB::table('hotels')->insert([
                'name' => Str::random(10),
                'address' => Str::random(20),
                'postcode' => Str::random(5),
                'postcode' => Str::random(5),
                'longitude' => rand(0, 10),
                'latitude' => rand(0,10),
                'type_id' => $i,
            ]);
        }
    }
}
