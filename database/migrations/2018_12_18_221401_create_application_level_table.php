<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_application_level', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('application_level', 100)->nullable();
            $table->unique(['application_level'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_application_level');
    }
}
