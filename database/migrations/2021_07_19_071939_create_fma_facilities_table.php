<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFMAFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fma_facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("station_id");
            $table->unsignedBigInteger("facility_type_id");
            $table->string("facility_name", 60);
            $table->text("comment");
            $table->string("operate_hour_start");
            $table->string("operate_hour_end");
            $table->smallInteger("status");
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
        Schema::dropIfExists('fma_facilities');
    }
}
