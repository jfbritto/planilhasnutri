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
                'name' => 'Alérgenos',
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
                'name' => 'Serviços',
                'status' => 'A'
            ],
            [
                'id' => 8,
                'id_unit' => null,
                'name' => 'Produtos',
                'status' => 'A'
            ],
            [
                'id' => 10,
                'id_unit' => null,
                'name' => 'Fornecedor',
                'status' => 'A'
            ],
            [
                'id' => 11,
                'id_unit' => null,
                'name' => 'Eventos',
                'status' => 'A'
            ],
            [
                'id' => 12,
                'id_unit' => null,
                'name' => 'Pragas',
                'status' => 'A'
            ],
            [
                'id' => 13,
                'id_unit' => null,
                'name' => 'Fabricantes',
                'status' => 'A'
            ]

        ]);
    }
}
