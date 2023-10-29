<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanilhasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planilhas')->insert([
            [
                'id' => 1,
                'name' =>  'Controle de Troca do Elemento Filtrante',
            ],
            [
                'id' => 2,
                'name' =>  'Higienização dos Filtros e Aparelhos de Climatização',
            ],
            [
                'id' => 3,
                'name' =>  'Controle de Saturação de Óleos e Gorduras',
            ],
            [
                'id' => 4,
                'name' =>  'Registro de Limpeza de Caixa de Gordura',
            ],
            [
                'id' => 5,
                'name' =>  'Registro de Congelamento',
            ],
            [
                'id' => 6,
                'name' =>  'Controle de Verificação do Procedimento de Higienização de Hortifrutis',
            ],
            [
                'id' => 7,
                'name' =>  'Relatório de Manutenção e Calibrações dos Equipamentos',
            ],
            [
                'id' => 8,
                'name' =>  'Registro de Limpeza',
            ],
            [
                'id' => 9,
                'name' =>  'Controle de Recebimento de Matéria Prima',
            ],
            [
                'id' => 10,
                'name' =>  'Controle de Resfriamento Rápido de Alimentos',
            ],
            [
                'id' => 11,
                'name' =>  'Controle de Reaquecimento dos Alimentos',
            ],
            [
                'id' => 12,
                'name' =>  'Registro de Não Conformidades Detectadas na Auto Avaliação',
            ],
            [
                'id' => 13,
                'name' =>  'Controle de Temperatura dos Alimentos no Banho-Maria',
            ],
            [
                'id' => 14,
                'name' =>  'Controle de Temperatura dos Alimentos na Distribuição',
            ],
            [
                'id' => 15,
                'name' =>  'Registro de Grupo de Amostras de Pratos',
            ],
            [
                'id' => 16,
                'name' =>  'Check-list de Avaliação do Manejo dos Resíduos',
            ],
            [
                'id' => 17,
                'name' =>  'Registro de Ocorrência de Pragas',
            ],
            [
                'id' => 18,
                'name' =>  'Controle de Temperatura de Equipamentos e Áreas Climatizadas',
            ],
        ]);
    }
}
