<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGetStaffPhotoProcedure extends Migration
{
    private $name = 'get_staff_photo';
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
        CREATE FUNCTION `{$this->name}`(`vno` varchar(20),inst bigint(20)) RETURNS varchar(100) CHARSET utf8
        BEGIN
            #Routine body goes here...
        select staff_passport into @empname from sch_staff where verification_no = vno and institution_id=inst;
            RETURN case when LENGTH(@empname) > 4 then @empname else '' end;
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
