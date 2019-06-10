<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 45);
            $table->string('user_password', 300)->nullable();
            $table->string('temp_password', 300)->nullable();
            $table->date('password_expiry_date')->nullable();
            $table->string('name', 156)->nullable();
            $table->string('email', 125);
            $table->string('photo_url', 100)->nullable();
            $table->string('phone', 15);
            $table->bigInteger('institution_id')->nullable();
            $table->integer('module_id')->nullable();
            $table->integer('user_group_id')->nullable();
            $table->boolean('status')->default('1');
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->boolean('is_student')->default('0');
            $table->boolean('is_staff')->default('0');
            $table->string('regno', 20)->nullable();
            $table->string('staff_code', 20)->nullable();
            $table->timestamps();
            $table->rememberToken();

            $table->unique('username', 'DUPLICATE_USERNAME');
            $table->unique('phone', 'DUPLICATE_PHONE');
            $table->unique('email', 'DUPLICATE_EMAIL');
            $table->index('module_id', 'fk_ModUsers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sup_users');
    }
}
