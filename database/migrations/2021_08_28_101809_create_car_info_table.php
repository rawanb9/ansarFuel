<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_infos', function (Blueprint $table) {
            $table->id();
            $table->String('serial');
            $table->String('timestamp');
            $table->String('name');
            $table->String('phone');
            $table->String('fuel_type');
            $table->String('car_type');
            $table->String('car_color');
            $table->String('car_plate');
            $table->foreignId('preferred_provider_id');
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
        Schema::dropIfExists('car_infos');
    }
}
