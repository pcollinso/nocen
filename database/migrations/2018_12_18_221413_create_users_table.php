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
            $table->date('password_expiry_date');
            $table->string('name', 156)->nullable();
            $table->string('email', 125);
            $table->string('photo_url', 100)->nullable();
            $table->string('phone', 15);
            $table->bigInteger('institution_id');
            $table->integer('module_id')->nullable();
            $table->integer('user_group_id')->nullable();
            $table->boolean('status')->default('1');
            $table->string('entered_by', 50)->nullable();
            $table->string('last_modified_by', 50)->nullable();
            $table->dateTime('approved_on')->nullable();
            $table->string('approved_by', 50)->nullable();
            $table->tinyInteger('first_login')->default('0');
            $table->string('hash_code', 50)->nullable();
            $table->dateTime('hash_code_sent_on')->nullable();
            $table->boolean('is_student')->default('0');
            $table->boolean('is_staff')->default('0');
            $table->string('email_link', 255)->nullable();
            $table->string('regno', 20)->nullable();
            $table->string('staff_code', 20)->nullable();
            $table->boolean('email_validated')->default('0');
            $table->boolean('phone_validated')->default('0');
            $table->dateTime('email_validated_on')->nullable();
            $table->dateTime('phone_validated_on')->nullable();
            $table->boolean('is_password_reset')->default('0');
            $table->string('auth_code', 255)->nullable();
            $table->timestamps();

            $table->unique('username', 'DUPLICATE_USERNAME');
            $table->unique('phone', 'DUPLICATE_PHONE');
            $table->unique('email', 'DUPLICATE_EMAIL');
            $table->index('module_id', 'fk_ModUsers');
            // $table->index('group_id', 'fk_GrpUsers');
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
