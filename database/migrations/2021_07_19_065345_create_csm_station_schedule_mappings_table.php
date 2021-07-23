<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSMStationScheduleMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csm_station_schedule_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("station_departure_id");
            $table->unsignedBigInteger("station_destination_id");

            $table->string("station_relation_name", 60)->nullable();

            $table->date("schedule_date")
                ->nullable();

            $table->string("departure_time", 6)
                ->nullable()
                ->comment("Example 00:00");

            $table->dateTime("arrival_time")
                ->nullable()
                ->comment("Example 23:59");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_s_m__station__schedule__mappings');
    }
}
