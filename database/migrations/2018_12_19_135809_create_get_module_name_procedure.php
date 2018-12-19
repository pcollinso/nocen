<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGetModuleNameProcedure extends Migration
{
    private $name = 'get_module_name';
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
        CREATE FUNCTION `{$this->name}`(id varchar(20)) RETURNS varchar(55) CHARSET utf8
        BEGIN
            #Routine body goes here...
        select module_name into @x from sup_module where sup_module.id = id;
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
