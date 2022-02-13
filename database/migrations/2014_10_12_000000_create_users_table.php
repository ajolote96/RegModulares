<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido');
            $table->string('correo',50)->unique();
            $table->string('codigo')->unique()->nullable();
            $table->string('tipo',50);
            $table->string('status',50)->default('sin_registro');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('horas_servicio',0,0)->nullable()->unsigned();
            $table->integer('horas',0,0)->nullable()->unsigned();
            $table->tinyText('carrera')->nullable();
            $table->string('tipo_cliente',50)->nullable();
        });
        DB::table('users')->insert([
            "name" =>"admin",
            "apellido" => "admin",
            "correo" => "admin@admin.com",
            "codigo" => null,
            "tipo" => "Superadmin",
            "email_verified_at" => null,
            "password" => Hash::make('123'),
            "remember_token"=> null,
            "horas_servicio" => null,
            "horas"=>null,
            "carrera"=> null,
            "tipo_cliente" => null,
        ]);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }


}
