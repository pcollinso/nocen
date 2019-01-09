<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetAgeFunction extends Migration
{
    private $name = 'get_age';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(d date) RETURNS int(11)
        BEGIN
        declare a int;
        set a = (YEAR(CURDATE())-YEAR(d)) - (RIGHT(CURDATE(),5)<RIGHT(d,5));
        return a;
        END
EOD;
        DB::unprepared($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS {$this->name}");
    }
}
