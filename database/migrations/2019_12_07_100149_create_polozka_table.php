<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolozkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Polozka', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nazov')->nullable();
            $table->integer('nakupna_cena')->nullable();
            $table->integer('predajna_cena')->nullable();
            $table->text('balenie')->nullable();
            $table->integer('mnozstvo')->nullable();
            $table->integer('id_miesto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Polozka');
    }
}
