<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baies', function (Blueprint $table) {
            $table->increments('id_baie');
            $table->char('batiment');
            $table->integer('seuil_baie_temp_critique_mini');
            $table->integer('seuil_baie_temp_critique_maxi');
            $table->integer('seuil_baie_temp_alerte_mini');
            $table->integer('seuil_baie_temp_alerte_maxi');
            $table->integer('seuil_equipement_temp_critique_mini');
            $table->integer('seuil_equipement_temp_critique_maxi');
            $table->integer('seuil_equipement_temp_alerte_mini');
            $table->integer('seuil_equipement_temp_alerte_maxi');
            $table->integer('seuil_baie_hum_critique');
            $table->integer('seuil_baie_hum_alerte');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baies');
    }
}
