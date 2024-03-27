<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;


class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::create(['country_id' => 1, 'name' => 'gujarat']);
        State::create(['country_id' => 1, 'name' => 'maharastra']);
        State::create(['country_id' => 2, 'name' => 'london']);
        State::create(['country_id' => 2, 'name' => 'peris']);
    }
}
