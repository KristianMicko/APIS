<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVlastnostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Vlastnost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nazov')->nullable();
            $table->text('popis')->nullable();
            $table->integer('id_polozka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Vlastnost');
    }
}
