<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_application_admission', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('application_id')->unsigned()->index();
            $table->integer('admission_year');
            $table->unsignedDecimal('total_utme_score', 5, 2);
            $table->unsignedDecimal('total_post_utme_score', 5, 2);
            $table->dateTime('post_utme_on');
            $table->boolean('admitted')->default('0');
            $table->dateTime('admitted_on');
            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_id')->references('id')->on('sch_application_bio')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_application_admission');
    }
}
