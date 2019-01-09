<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetHoursBetweenFunction extends Migration
{
    private $name = 'get_hours_between';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(start_date varchar(20),end_date varchar(20)) RETURNS int(11)
        BEGIN
            return TIMESTAMPDIFF(HOUR,case when start_date is null or start_date='0000-00-00' or start_date='' then '1970-01-01' else start_date end,
        case when end_date is null or end_date='0000-00-00' or end_date='' then '1970-01-01' else end_date end);
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
