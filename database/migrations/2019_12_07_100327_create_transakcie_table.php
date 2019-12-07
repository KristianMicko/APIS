<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransakcieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transakcie', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mnozstvo')->nullable();
            $table->integer('typ');
            $table->integer('id_polozka');
            $table->date('datum');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Transakcie');
    }
}
