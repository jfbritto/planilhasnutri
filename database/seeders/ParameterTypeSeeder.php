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
            ],
            [
                'id' => 5,
                'id_unit' => null,
                'name' => 'Situações Gordura',
                'status' => 'A'
            ],
            [
                'id' => 6,
                'id_unit' => null,
                'name' => 'Caixas de Gordura',
                'status' => 'A'
            ],
            [
                'id' => 7,
                'id_unit' => null,
                'name' => 'Locais',
                'status' => 'A'
            ],
            [
                'id' => 8,
                'id_unit' => null,
                'name' => 'Produtos',
                'status' => 'A'
            ],
            [
                'id' => 9,
                'id_unit' => null,
                'name' => 'Alimentos',
                'status' => 'A'
            ]

        ]);
    }
}
