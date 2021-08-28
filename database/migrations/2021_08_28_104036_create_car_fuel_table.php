<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarFuelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_fuels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_Id');
            $table->String('schedule_date');
            $table->String('fill_date');
            $table->String('scheduled_amount');
            $table->String('provider');
            $table->foreignId('provider_Id');
            $table->foreignId('user_Id');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('car_fuels');
    }
}
