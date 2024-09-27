<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Aprovador',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'profile' => 'approver'
            ],

            [
                'name' => 'Usuário Solicitante',
                'email' => 'solicitante@example.com',
                'password' => Hash::make('12345678'),
                'profile' => 'requester',
            ]
        ]);
    }
}
