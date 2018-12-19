<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_qualf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qualf_name', 100);
            $table->string('qualf_title', 30);
            $table->tinyInteger('status')->default('1');
            $table->unique('qualf_name', 'unique_qualf_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_qualf');
    }
}
