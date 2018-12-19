<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_faculty', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id');
            $table->bigInteger('programme_id');
            $table->string('faculty_name', 255)->nullable();
            $table->string('faculty_code', 255)->nullable();
            $table->string('faculty_abbrv', 50)->nullable();
            $table->bigInteger('entered_by')->nullable();
            $table->bigInteger('last_modified_by')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_faculty');
    }
}
