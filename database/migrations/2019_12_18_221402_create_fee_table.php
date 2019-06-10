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
            $table->tinyInteger('application_level_id')->unsigned()->index()->comment('this fee can be applied to any level e.g to a department or to individual jambite or regular student or to a faculty.if application level is 1 for example, then a value is expected in the j_regno column means this is applied to a jambite');
            $table->bigInteger('institution_id')->unsigned()->index()->default('0');
            $table->bigInteger('programme_id')->unsigned()->index()->default('0');
            $table->bigInteger('faculty_id')->unsigned()->index()->default('0');
            $table->bigInteger('department_id')->unsigned()->index()->default('0');
            $table->bigInteger('field_id')->unsigned()->index()->default('0');
            $table->bigInteger('level_id')->unsigned()->index()->default('0');
            $table->string('j_regno', 20)->nullable()->index()->default('0');
            $table->string('regno', 20)->nullable()->index()->default('0');
            $table->tinyInteger('payment_type_id')->unsigned()->index()->comment('this can be 0 for full, 1 for first payment and 2 for second payment');
            $table->timestamps();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->boolean('active')->default('0');

            $table->unique(['institution_id','fee_type_id','application_level_id','j_regno','regno','field_id','department_id','faculty_id','programme_id','level_id','payment_type_id'], 'DUPLICATE_RECORD');
            /*$table->unique(['fee_type_id','application_level_id','field_id','level_id','payment_type_id'], 'DUPLICATE_FIELD_LEVEL');
            $table->unique(['fee_type_id','application_level_id','department_id','level_id','payment_type_id'], 'DUPLICATE_DEPARTMENT_LEVEL');
            $table->unique(['fee_type_id','application_level_id','faculty_id','level_id','payment_type_id'], 'DUPLICATE_FACULTY_LEVEL');
            $table->unique(['fee_type_id','application_level_id','programme_id','level_id','payment_type_id'], 'DUPLICATE_PROGRAMME_LEVEL');
            $table->unique(['fee_type_id','application_level_id','institution_id','level_id','payment_type_id'], 'DUPLICATE_INSTITUTION_LEVEL');
            $table->unique(['institution_id','fee_type_id','application_level_id','j_regno','payment_type_id'], 'DUPLICATE_JAMB_NO');
            $table->unique(['institution_id','fee_type_id','application_level_id','regno','payment_type_id'], 'DUPLICATE_MATRIC_NO');*/

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
