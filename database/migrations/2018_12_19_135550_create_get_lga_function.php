<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetLgaFunction extends Migration
{
    private $name = 'get_lga';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(`id` varchar(20)) RETURNS varchar(50) CHARSET utf8
        BEGIN
            if id=0 or id is null or id="" then set @x='N/A';end if;
        select `name` into @x from sup_lga where sup_lga.id = id;
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
