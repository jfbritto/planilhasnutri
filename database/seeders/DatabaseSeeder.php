<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(ParameterTypeSeeder::class);
        $this->call(ParameterSeeder::class);
        $this->call(PlanilhasSeeder::class);
    }
}
