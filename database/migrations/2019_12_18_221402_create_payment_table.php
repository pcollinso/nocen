<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fee_id')->unsigned()->index();
            $table->tinyInteger('payment_type_id')->unsigned()->index()->comment('this can be 0 for full, 1 for first payment and 2 for second payment');
            $table->bigInteger('institution_id')->unsigned()->index();
            $table->bigInteger('level_id')->nullable();
            $table->string('j_regno', 100)->nullable()->index();
            $table->string('regno', 100)->nullable()->index();
            $table->unsignedDecimal('amount', 10, 2);
            $table->string('rrr', 100)->nullable()->index();
            $table->string('order_id', 100)->nullable()->index();
            $table->boolean('completed')->default('0');
            $table->timestamps();

            $table->unique(['institution_id','fee_id','j_regno','regno'], 'DUPLICATE_REG_NO');
            $table->unique(['rrr'], 'DUPLICATE_CONFIRMATION_NO');
            $table->unique(['order_id'], 'DUPLICATE_RECEIPT_NO');
            $table->foreign('institution_id')->references('id')->on('sup_institution')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fee_id')->references('id')->on('sch_fee')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_type_id')->references('id')->on('sys_payment_type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_payment');
    }
}
