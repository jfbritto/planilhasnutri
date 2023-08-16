<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' =>  'João Filipi',
                'id_unit' =>  null,
                'is_admin' =>  true,
                'is_nutri' =>  false,
                'email' => 'jf.britto@hotmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' =>  'Brunelli Sperandio Busteke',
                'id_unit' =>  8,
                'is_admin' =>  false,
                'is_nutri' =>  true,
                'email' => 'brunellisbusteke@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' =>  'Eduarda Sperandio Busteke',
                'id_unit' =>  2,
                'is_admin' =>  false,
                'is_nutri' =>  true,
                'email' => 'dudasbusteke@gmail.com',
                'password' => Hash::make('12345678')
            ]
        ]);
    }
}
