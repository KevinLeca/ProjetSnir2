<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesuresBaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesures_baies', function (Blueprint $table) {
            $table->increments('id_mesures');
            $table->int('id_baie');
            $table->foreign('id_baie')->references('id_baie')->on('baies');
            $table->int('temperature');
            $table->int('humidite');
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
        Schema::dropIfExists('mesures_baies');
    }
}
