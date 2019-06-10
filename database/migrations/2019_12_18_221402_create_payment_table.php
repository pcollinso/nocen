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
            $table->string('confirmation_no', 100)->nullable()->index();
            $table->string('receipt_no', 100)->nullable()->index();
            $table->string('terminal_id', 100)->nullable()->index();
            $table->string('payment_code', 50)->nullable()->index();
            $table->string('merchant_code', 50)->nullable()->index();
            $table->string('payment_date', 50)->nullable()->index();
            $table->string('payment_description', 200)->nullable();
            $table->string('cbn_code', 10)->nullable()->index();
            $table->string('bank_name', 100)->nullable()->index();
            $table->string('bank_branch', 100)->nullable();
            $table->string('lead_bank_code', 10)->nullable();
            $table->string('lead_bank_name', 100)->nullable();
            $table->string('customer_name', 100)->nullable();
            $table->string('teller_id', 100)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_currency', 100)->nullable();
            $table->string('transaction_type', 100)->nullable();
            $table->string('payment_fee_type', 50)->nullable();
            $table->timestamps();

            $table->unique(['institution_id','fee_id','j_regno','regno'], 'DUPLICATE_REG_NO');
            $table->unique(['confirmation_no'], 'DUPLICATE_CONFIRMATION_NO');
            $table->unique(['receipt_no'], 'DUPLICATE_RECEIPT_NO');
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
