<?php

namespace Database\Seeders;

use App\Models\acara;
use App\Models\grade;
use App\Models\lomba;
use App\Models\penonton;
use App\Models\peserta;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        peserta::factory(10)->create();
        penonton::factory(10)->create();
        acara::factory(10)->create();
        grade::factory(4)->create();
        lomba::factory(4)->create();
        User::factory(1)->create();
    }
}
