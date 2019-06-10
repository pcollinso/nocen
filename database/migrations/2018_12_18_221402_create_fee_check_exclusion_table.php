<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeCheckExclusionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_fee_check_exclusion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fee_type_id')->unsigned()->index();
            $table->string('j_regno', 20)->nullable();
            $table->string('regno', 20)->nullable();
            $table->string('staff_code', 20)->nullable();

            $table->unique(['fee_type_id','j_regno','regno','staff_code'], 'DUPLICATE_RECORD');
            $table->foreign('fee_type_id')->references('id')->on('sch_fee_type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_fee_check_exclusion');
    }
}
