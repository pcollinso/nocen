<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_field', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->nullable();
            $table->bigInteger('programme_id')->nullable();
            $table->bigInteger('faculty_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->string('field_name', 100)->nullable();
            $table->string('field_code', 100)->nullable();
            $table->string('field_abbrv', 50)->nullable();
            $table->bigInteger('entered_by')->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->unique(['institution_id','programme_id','faculty_id','department_id','field_name'], 'DUPLICATE_RECORD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_field');
    }
}
