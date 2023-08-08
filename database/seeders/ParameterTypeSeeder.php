<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParameterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameter_types')->insert([
            [
                'id_unit' => null,
                'name' => 'Cozinha',
                'status' => 'A'
            ],
            [
                'id_unit' => null,
                'name' => 'Refeitório',
                'status' => 'A'
            ]

        ]);
    }
}
