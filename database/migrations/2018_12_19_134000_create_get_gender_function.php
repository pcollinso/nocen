<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetGenderFunction extends Migration
{
    private $name = 'get_gender';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(a varchar(20)) RETURNS varchar(55) CHARSET utf8
        BEGIN
            #Routine body goes here...
        select gender_name into @x from sch_gender where id = a;
        if ROW_COUNT() < 1 then set @x='n/a';end if;
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
