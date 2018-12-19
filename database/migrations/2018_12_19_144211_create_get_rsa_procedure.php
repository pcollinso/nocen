<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGetRsaProcedure extends Migration
{
    private $name = 'get_rsa';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        DELIMITER ;;
        CREATE FUNCTION `{$this->name}`(id varchar(20)) RETURNS varchar(30) CHARSET utf8
        BEGIN
            if id=0 or id is null or id="" then set @x='N/A';end if;
        select rsa_number into @x from hr_personal_info where verification_no=id;
        if ROW_COUNT() < 1 then set @x='n/a';end if;
            RETURN @x;
        END
        ;;
        DELIMITER ;
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
