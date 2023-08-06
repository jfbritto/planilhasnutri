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
                'name' => 'Golden Tulip Porto VItória',
                'city' => 'Vitória',
                'neighborhood' => 'Centro',
                'description' => 'teste',
                'status' => 'A'
            ],
            [
                'name' => 'Tulip Inn',
                'city' => 'Itaparica',
                'neighborhood' => 'Itaparica',
                'description' => 'teste',
                'status' => 'A'
            ]
        ]);
    }
}
