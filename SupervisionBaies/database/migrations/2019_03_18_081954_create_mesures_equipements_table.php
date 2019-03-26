<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesuresEquipementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesures_equipements', function (Blueprint $table) {
            $table->increments('id_mersure');
            $table->int('id_equipement');
            $table->foreign('id_equipement')->references('id_equipement')->on('equipements');
            $table->int('temperature');
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
        Schema::dropIfExists('mesures_equipements');
    }
}
