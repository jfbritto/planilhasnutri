<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters')->insert([
            // areas
            [
                'id' => 1,
                'id_parameter_type' => 1,
                'name' => 'Cozinha',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 2,
                'id_parameter_type' => 1,
                'name' => 'Refeitório',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 3,
                'id_parameter_type' => 1,
                'name' => 'Recepção',
                'id_unit' => null,
                'status' => 'A'
            ],
            // filtros
            [
                'id' => 4,
                'id_parameter_type' => 2,
                'name' => 'Maquina de café',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 5,
                'id_parameter_type' => 2,
                'name' => 'Bebedouro',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 6,
                'id_parameter_type' => 2,
                'name' => 'Chopeira',
                'id_unit' => null,
                'status' => 'A'
            ],
            // responsaveis
            [
                'id' => 7,
                'id_parameter_type' => 3,
                'name' => 'João',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 8,
                'id_parameter_type' => 3,
                'name' => 'Brunelli',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 9,
                'id_parameter_type' => 3,
                'name' => 'Adolfo',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 10,
                'id_parameter_type' => 3,
                'name' => 'Felipe',
                'id_unit' => null,
                'status' => 'A'
            ],
            // equipamentos
            [
                'id' => 11,
                'id_parameter_type' => 4,
                'name' => 'Furadeira',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 12,
                'id_parameter_type' => 4,
                'name' => 'Aspirador de pó',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 13,
                'id_parameter_type' => 4,
                'name' => 'Maquina de lavar',
                'id_unit' => null,
                'status' => 'A'
            ],
            // situação gordura
            [
                'id' => 14,
                'id_parameter_type' => 5,
                'name' => 'Boa',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 15,
                'id_parameter_type' => 5,
                'name' => 'Ruim',
                'id_unit' => null,
                'status' => 'A'
            ],
            // caixas de gordura
            [
                'id' => 16,
                'id_parameter_type' => 6,
                'name' => 'Caixa do restaurante',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 17,
                'id_parameter_type' => 6,
                'name' => 'Caixa do sky',
                'id_unit' => null,
                'status' => 'A'
            ],
            // alimentos
            [
                'id' => 18,
                'id_parameter_type' => 9,
                'name' => 'Banana',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 19,
                'id_parameter_type' => 9,
                'name' => 'Maçã',
                'id_unit' => null,
                'status' => 'A'
            ],
            // evento
            [
                'id' => 20,
                'id_parameter_type' => 11,
                'name' => 'Rock in Rio',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 21,
                'id_parameter_type' => 11,
                'name' => 'Vital',
                'id_unit' => null,
                'status' => 'A'
            ],
            // produtos
            [
                'id' => 22,
                'id_parameter_type' => 8,
                'name' => 'Macarronada',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 23,
                'id_parameter_type' => 8,
                'name' => 'feijão',
                'id_unit' => null,
                'status' => 'A'
            ],

        ]);
    }
}
