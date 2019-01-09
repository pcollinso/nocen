<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetCityFunction extends Migration
{
    private $name = 'get_city';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(`value_id` varchar(20)) RETURNS varchar(50) CHARSET utf8
        BEGIN
            #Routine body goes here...
        select `name` into @x from sup_cities where id = value_id;
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
