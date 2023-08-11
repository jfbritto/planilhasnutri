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
                'name' => 'Áreas',
                'status' => 'A'
            ],
            [
                'id' => 2,
                'id_unit' => null,
                'name' => 'Filtros',
                'status' => 'A'
            ],
            [
                'id' => 3,
                'id_unit' => null,
                'name' => 'Responsáveis',
                'status' => 'A'
            ],
            [
                'id' => 4,
                'id_unit' => null,
                'name' => 'Equipamentos',
                'status' => 'A'
            ]

        ]);
    }
}
