<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('institution_id');
            $table->string('user_id', 100);
            $table->string('name', 100)->nullable();
            $table->string('action', 100)->nullable();
            $table->mediumText('old_data')->nullable();
            $table->mediumText('new_data')->nullable();
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
        Schema::dropIfExists('action_history');
    }
}
