<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeIsActiveFunction extends Migration
{
    private $name = 'employee_is_active';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(`ver` varchar(50), i bigint(20)) RETURNS varchar(150) CHARSET utf8
        BEGIN
            if i='' or ver='' then set @x=0;end if;
        select case when count(*)>=1 then 1 else 0 end into @x from hr_personal_info where institution_id = i and verification_no=ver and active > 0;
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
