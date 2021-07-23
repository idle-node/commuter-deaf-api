<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSMStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csm_stations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("schedule_master_id");
            $table->unsignedBigInteger("station_name");
            $table->text("station_address");
            $table->double("station_lat")
                ->comment("-90 to 90");

            $table->double("station_lng")
                ->comment("-180 to 180");

            $table->text("comment");
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
        Schema::dropIfExists('c_s_m__stations');
    }
}
