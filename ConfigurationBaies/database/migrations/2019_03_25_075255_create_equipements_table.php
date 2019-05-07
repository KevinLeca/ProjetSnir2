<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipements', function (Blueprint $table) {
            $table->increments('id_equipement');
            $table->string('adresse_ip');
            $table->integer('seuil_baie_temp_critique_maxi');
            $table->integer('id_baie');
            $table->foreign('id_baie')->references('id_baie')->on('baies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipements');
    }
}
