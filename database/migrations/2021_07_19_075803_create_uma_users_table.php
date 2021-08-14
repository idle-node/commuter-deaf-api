<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUMAUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uma_users', function (Blueprint $table) {
            $table->id();
            $table->string("username", 60);
            $table->string("email", 255)->nullable();
            $table->text('password');
            $table->string("phone", 20);
            $table->string("fullname", 60);
            $table->integer("age")->nullable();
            $table->tinyInteger("status");
            $table->dateTime("last_active");
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
        Schema::dropIfExists('uma_users');
    }
}
