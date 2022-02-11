<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'nombre'=>'Sergio',
            'paterno'=>'Reyes',
            'materno'=>'Aguila',
            'password'=>bcrypt('12345678'),
            'codigo'=>'214569057',
            'email'=>'sergioreag@hotmail.com'
        ])->assignRole('Admin');
        User::create([
            'nombre'=>'Eduardo',
            'paterno'=>'Guerrero',
            'materno'=>'Figueroa',
            'password'=>bcrypt('12345678'),
            'codigo'=>'213743096',
            'email'=>'hola@ejemplo.com'
        ])->assignRole('Admin');

    }
}
