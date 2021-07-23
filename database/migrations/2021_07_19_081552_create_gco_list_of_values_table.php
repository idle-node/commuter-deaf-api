<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGCOListOfValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gco_list_of_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("parent_id")
                ->comment("If parent_id = 0, then this data is a parent.");
            $table->string("key", 60)
                ->comment("The key of value. A LOV parent cannot have same key. Also LOV in a same parent cannot have same key.");
            $table->text("value");
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
        Schema::dropIfExists('g_c_o__list__of__values');
    }
}
