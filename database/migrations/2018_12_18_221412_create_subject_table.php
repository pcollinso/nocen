<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject_name', 100);
            $table->string('subject_code', 20);
            $table->unique('subject_name', 'unique_subject_name');
            $table->unique('subject_code', 'unique_subject_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_subject');
    }
}
