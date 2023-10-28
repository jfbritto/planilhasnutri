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
                'name' => 'Soja',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 15,
                'id_parameter_type' => 5,
                'name' => 'Glúten',
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
                'id' => 31,
                'id_parameter_type' => 8,
                'name' => 'Mamão',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 32,
                'id_parameter_type' => 8,
                'name' => 'Melão',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 33,
                'id_parameter_type' => 8,
                'name' => 'Melancia',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 34,
                'id_parameter_type' => 8,
                'name' => 'Abacaxi',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 35,
                'id_parameter_type' => 8,
                'name' => 'Salada de Frutas',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 36,
                'id_parameter_type' => 8,
                'name' => 'Iogurte',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 37,
                'id_parameter_type' => 8,
                'name' => 'Suco de Laranja',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 38,
                'id_parameter_type' => 8,
                'name' => 'Suco Detox',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 39,
                'id_parameter_type' => 8,
                'name' => 'Água Frutada',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 40,
                'id_parameter_type' => 8,
                'name' => 'Presunto',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 41,
                'id_parameter_type' => 8,
                'name' => 'Queijo Branco',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 42,
                'id_parameter_type' => 8,
                'name' => 'Mussarela',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 43,
                'id_parameter_type' => 8,
                'name' => 'Peito de Peru',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 44,
                'id_parameter_type' => 8,
                'name' => 'Requeijão Sachê',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 45,
                'id_parameter_type' => 8,
                'name' => 'Manteiga Sachê c/ sal',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 46,
                'id_parameter_type' => 8,
                'name' => 'Vitamina',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 47,
                'id_parameter_type' => 8,
                'name' => 'Leite Integral Quente',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 48,
                'id_parameter_type' => 8,
                'name' => 'Leite Desnatado',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 49,
                'id_parameter_type' => 8,
                'name' => 'Leite De Soja',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 50,
                'id_parameter_type' => 8,
                'name' => 'Leite sem Lactose',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 51,
                'id_parameter_type' => 8,
                'name' => 'Leite Integral Gelado',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 52,
                'id_parameter_type' => 8,
                'name' => 'Ovos Mexidos',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 53,
                'id_parameter_type' => 8,
                'name' => 'Calabresa ou Salsicha',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 54,
                'id_parameter_type' => 8,
                'name' => 'Pão de Queijo',
                'id_unit' => null,
                'status' => 'A'
            ],
            // pragas
            [
                'id' => 24,
                'id_parameter_type' => 12,
                'name' => 'Barata',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 25,
                'id_parameter_type' => 12,
                'name' => 'Mosca',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 26,
                'id_parameter_type' => 12,
                'name' => 'Formiga',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 27,
                'id_parameter_type' => 12,
                'name' => 'Aranha',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 28,
                'id_parameter_type' => 12,
                'name' => 'Roedores',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 29,
                'id_parameter_type' => 12,
                'name' => 'Carunchos',
                'id_unit' => null,
                'status' => 'A'
            ],
            [
                'id' => 30,
                'id_parameter_type' => 12,
                'name' => 'Outros',
                'id_unit' => null,
                'status' => 'A'
            ],

        ]);
    }
}
