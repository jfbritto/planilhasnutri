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
                'id' => 1,
                'id_unit' => null,
                'name' => 'Área',
                'status' => 'A'
            ],
            [
                'id' => 2,
                'id_unit' => null,
                'name' => 'Filtro',
                'status' => 'A'
            ],
            [
                'id' => 3,
                'id_unit' => null,
                'name' => 'Responsável',
                'status' => 'A'
            ]

        ]);
    }
}
