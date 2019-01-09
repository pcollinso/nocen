<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffIsDeanFunction extends Migration
{
    private $name = 'staff_is_dean';
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
        CREATE FUNCTION `{$this->name}`(`vno` varchar(20), inst bigint(20)) RETURNS tinyint(1)
        BEGIN
            #Routine body goes here...
        select case when count(*)>=1 then 1 else 0 end into @empname from sch_dean sd inner join sch_staff ss on sd.institution_id=ss.institution_id and sd.staff_id=ss.id
        where ss.verification_no=vno and ss.institution_id=inst and ss.active=1;
            RETURN @empname;
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
