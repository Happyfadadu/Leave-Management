<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create(['state_id' => 1, 'name' => 'Ahmedabad']);
        City::create(['state_id' => 1, 'name' => 'Rajkot']);
        City::create(['state_id' => 2, 'name' => 'mumbai']);
        City::create(['state_id' => 2, 'name' => 'pune']);
        City::create(['state_id' => 3, 'name' => 'tokyo']);
        City::create(['state_id' => 3, 'name' => 'honkong']);
        City::create(['state_id' => 4, 'name' => 'ABC']);
        City::create(['state_id' => 4, 'name' => 'XYZ']);
    }
}
