<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenVerificationNoFunction extends Migration
{
    private $name = 'gen_verification_no';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(arg int(11)) RETURNS varchar(10) CHARSET utf8
        BEGIN
            #Routine body goes here...
         declare inst_name VARCHAR(55);
          select institution_code into inst_name from sup_institution where id = arg;
           set @x = concat(upper(SUBSTRING(inst_name, 1, 2)),REPLACE(RIGHT(REPLACE(RAND(), '.', '0'), 8), 'e', '0'));
            RETURN @x;
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
