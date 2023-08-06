<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorksheetStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('worksheet_structures')->insert([
            [
                'id_user' => 1,
                'name' => 'Temperatura do alimentos',
                'description' => 'teste',
                'status' => 'A'
            ],
            [
                'id_user' => 1,
                'name' => 'Controle de Higienização dos Filtros e Aparelhos de Climatização',
                'description' => 'teste',
                'status' => 'A'
            ],
            [
                'id_user' => 1,
                'name' => 'Registro de ocorrência de pragas',
                'description' => 'teste',
                'status' => 'A'
            ],
            [
                'id_user' => 1,
                'name' => 'Controle de Troca do Elemento Filtrante',
                'description' => 'teste',
                'status' => 'A'
            ]

        ]);
    }
}
