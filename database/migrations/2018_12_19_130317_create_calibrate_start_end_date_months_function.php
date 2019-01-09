<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalibrateStartEndDateMonthsFunction extends Migration
{
    private $name = 'calibrate_start_end_date_months';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(start_date date,end_date date) RETURNS longtext CHARSET utf8
        BEGIN

        DECLARE x LONGTEXT;
        SET @months = - 1;

        SELECT
            group_concat(
                DATE_FORMAT(date_range, '%c')
            ) AS result_date
        FROM
            (
                SELECT
                    (
                        date_add(
                            start_date,
                            INTERVAL (@months := @months + 1) MONTH
                        )
                    ) AS date_range
                FROM
                    years a
                LIMIT 0,
                1000
            ) a
        WHERE
            a.date_range BETWEEN start_date
        AND last_day(end_date) INTO x;

        RETURN x;
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
