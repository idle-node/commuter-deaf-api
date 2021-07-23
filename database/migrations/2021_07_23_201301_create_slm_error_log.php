<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlmErrorLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slm_error_log', function (Blueprint $table) {
            $table->id();

            $table->string('module', 10)
                ->comment('e.g. UMA ; CSM ; GCO');

            $table->string('code', 10)
                ->comment('e.g. 200 ; 500 ; 404');

            $table->text('description')
                ->nullable()
                ->comment('Could be Stack Trace, or custom error message.');

            $table->dateTime("created_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slm_error_log');
    }
}
