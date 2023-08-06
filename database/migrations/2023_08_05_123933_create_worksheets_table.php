<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worksheets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_unit');
            $table->integer('id_worksheet_structure');
            $table->string('description', 100)->nullable();
            $table->string('status', 5)->default('A');
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
        Schema::dropIfExists('worksheets');
    }
}
