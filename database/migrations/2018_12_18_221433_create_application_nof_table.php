<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationNofTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_application_nof', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('application_id')->unsigned()->index();
            $table->string('surname', 45)->nullable();
            $table->string('first_name', 45)->nullable();
            $table->string('middle_name', 45)->nullable();
            $table->bigInteger('relationship_id')->unsigned()->index();
            $table->integer('gender_id')->unsigned()->index();
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->boolean('locked')->default('0');
            $table->timestamps();

            $table->unique(['institution_id','application_id','surname','first_name','middle_name','relationship_id','gender_id'], 'DUPLICATE_RECORD');

            $table->foreign('gender_id')->references('id')->on('sch_gender')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_id')->references('id')->on('sch_application_bio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('relationship_id')->references('id')->on('sup_relationships')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_application_nof');
    }
}
