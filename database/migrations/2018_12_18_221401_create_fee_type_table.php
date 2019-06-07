<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_fee_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fee_type', 100)->nullable();
            $table->unique(['fee_type'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_fee_type');
    }
}
