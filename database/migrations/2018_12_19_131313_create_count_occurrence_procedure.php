<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCountOccurrenceProcedure extends Migration
{
    private $name = 'count_occurrence';
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
        CREATE FUNCTION `{$this->name}`(needle varchar(100),hay varchar(200)) RETURNS int(20)
        BEGIN
        select ROUND (
                (
                    LENGTH(hay)
                    - LENGTH( REPLACE ( hay, needle, "") )
                ) / LENGTH(needle)
            ) AS count into @x;
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
