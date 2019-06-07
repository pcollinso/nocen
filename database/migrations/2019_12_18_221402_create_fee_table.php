<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_fee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fee_type_id')->unsigned()->index();
            $table->string('fee_description', 100)->nullable();
            $table->unsignedDecimal('amount', 10, 2);
            $table->boolean('is_one_off')->default('0');
            $table->tinyInteger('application_level_id')->unsigned()->index();
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('programme_id')->unsigned()->index();
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->bigInteger('field_id')->unsigned()->index();
            $table->tinyInteger('payment_type_id')->unsigned()->index()->comment('this can be 0 for full, 1 for first payment and 2 for second payment');
            $table->string('j_regno', 20)->nullable()->index();
            $table->string('regno', 20)->nullable()->index();
            $table->timestamps();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->boolean('active')->default('0');

            $table->unique(['institution_id','fee_type_id','application_level_id','j_regno'], 'DUPLICATE_JAMB_NO');
            $table->unique(['institution_id','fee_type_id','application_level_id','regno'], 'DUPLICATE_MATRIC_NO');
            $table->unique(['institution_id','fee_type_id','application_level_id','field_id'], 'DUPLICATE_FIELD');
            $table->unique(['institution_id','fee_type_id','application_level_id','department_id'], 'DUPLICATE_DEPARTMENT');
            $table->unique(['institution_id','fee_type_id','application_level_id','faculty_id'], 'DUPLICATE_FACULTY');
            $table->unique(['institution_id','fee_type_id','application_level_id','programme_id'], 'DUPLICATE_PROGRAMME');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programme_id')->references('id')->on('sch_programme')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('faculty_id')->references('id')->on('sch_faculty')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('sch_department')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('field_id')->references('id')->on('sch_field')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fee_type_id')->references('id')->on('sch_fee_type')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_type_id')->references('id')->on('sys_payment_type')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('application_level_id')->references('id')->on('sys_application_level')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_fee');
    }
}
