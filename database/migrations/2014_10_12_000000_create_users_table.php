<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('id_unit')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_nutri')->default(true);
            $table->boolean('is_estagiario')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status', 1)->default('A');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
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
