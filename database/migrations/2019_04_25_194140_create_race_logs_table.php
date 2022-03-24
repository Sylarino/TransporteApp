<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_logs', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('driver_shift_id');
            $table->string('patent');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('from_id')->nullable();
            $table->integer('to_id')->nullable();
            $table->string('from_text')->nullable();
            $table->string('to_text')->nullable();
            $table->integer('passengers_count');
            $table->string('passengers');
            $table->string('start_mileage');
            $table->string('end_mileage');
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('race_logs');
    }
}
