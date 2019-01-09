<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetMonthFunction extends Migration
{
    private $name = 'get_month';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(`id` varchar(50)) RETURNS varchar(50) CHARSET utf8
        BEGIN
            if id=0 or id is null or id="" then set @x='N/A';end if;
        select month_name into @x from sup_months where `month` = id;
             if(@x is null) then
        return null;
        else
            RETURN @x;
        end if;
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
