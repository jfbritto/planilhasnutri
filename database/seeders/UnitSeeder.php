<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            [
                'id' => 1,
                'name' => 'Royal Tulip Brasília',
                'city' => 'Brasília',
                'sigla' => 'royal',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 2,
                'name' => 'Royal Tulip JP',
                'city' => 'Ribeirão Preto',
                'sigla' => 'royal',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 3,
                'name' => 'Royal Tulip Holambra',
                'city' => 'Holambra',
                'sigla' => 'royal',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 4,
                'name' => 'Golden Tulip Brasília Alvorada',
                'city' => 'Vitória',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 5,
                'name' => 'Golden Tulip Goiânia',
                'city' => 'Goiânia',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 6,
                'name' => 'Golden Tulip Macaé',
                'city' => 'Macaé',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 7,
                'name' => 'Golden Tulip Natal',
                'city' => 'Natal',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 8,
                'name' => 'Golden Tulip Porto Vitória',
                'city' => 'Vitória',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 9,
                'name' => 'Golden Tulip São José dos Campos',
                'city' => 'São José dos Campos',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 10,
                'name' => 'Golden Tulip Canela',
                'city' => 'Canela',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 11,
                'name' => 'Golden Tulip Gravatá',
                'city' => 'Gravatá',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 12,
                'name' => 'Golden Tulip Jericoacoara',
                'city' => 'Jericoacoara',
                'sigla' => 'golden',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 13,
                'name' => 'Tulip Inn Campos dos Goytacazes',
                'city' => 'Campos dos Goytacazes',
                'sigla' => 'tulip',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 14,
                'name' => 'Tulip Inn Itaguaí',
                'city' => 'Itaguaí',
                'sigla' => 'tulip',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 15,
                'name' => 'Tulip Inn Fortaleza',
                'city' => 'Fortaleza',
                'sigla' => 'tulip',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 16,
                'name' => 'Tulip Inn Sete Lagoas',
                'city' => 'Sete Lagoas',
                'sigla' => 'tulip',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 17,
                'name' => 'Tulip Inn Sorocaba',
                'city' => 'Sorocaba',
                'sigla' => 'tulip',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 18,
                'name' => 'Tulip Inn Vila Velha',
                'city' => 'Vila Velha',
                'sigla' => 'tulip',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 19,
                'name' => 'Tulip Inn Bauru',
                'city' => 'Bauru',
                'sigla' => 'tulip',
                'description' => '',
                'status' => 'A'
            ],
            [
                'id' => 20,
                'name' => 'Soft Inn Bahia',
                'city' => 'Bahia',
                'sigla' => 'soft',
                'description' => '',
                'status' => 'A'
            ],
        ]);
    }
}
