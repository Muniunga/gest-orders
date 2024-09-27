<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materials')->insert([
            [
                'name' => 'Notebook',
                'price' => 1500,
            ],
            [
                'name' => 'Mouse',
                'price' => 50,
            ],
            [
                'name' => 'Teclado',
                'price' => 100,
            ],
            [
                'name' => 'Monitor',
                'price' => 300,
            ],
            [
                'name' => 'Cadeira de Escritório',
                'price' => 800,
            ],
            [
                'name' => 'Mesa de Escritório',
                'price' => 1200,
            ],
            [
                'name' => 'Impressora',
                'price' => 600,
            ],
            [
                'name' => 'Projetor',
                'price' => 2500,
            ],

        ]);

    }
}
