<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCalculateCommaValuesProcedure extends Migration
{
    private $name = 'calculate_comma_values';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP PROCEDURE IF EXISTS `{$this->name}`;
        DELIMITER ;;
        CREATE PROCEDURE `{$this->name}`(in vars varchar(200),in k varchar(50),out x decimal(50,2))
            COMMENT 'this procedure checks for sum,max,min for comma separated values'
        BEGIN
        declare n decimal(50,2);
        DROP TABLE IF EXISTS xxxxxaaaaabbbbb;
        CREATE TABLE xxxxxaaaaabbbbb (num DECIMAL(50, 2));

        SET @SQL = concat(
            "insert into xxxxxaaaaabbbbb (num) values ('",
            REPLACE (vars, ",", "'),('"),
            "');"
        );
        PREPARE stmt1 FROM @SQL;
        EXECUTE stmt1;
        SELECT
            (
                CASE
                WHEN k = 'sum' THEN
                    (
                        SELECT
                            sum(num)
                        FROM
                            xxxxxaaaaabbbbb
                    )
                WHEN k = 'avg' THEN
                    (
                        SELECT
                            avg(num)
                        FROM
                            xxxxxaaaaabbbbb
                    )
                WHEN k = 'max' THEN
                    (
                        SELECT
                            max(num)
                        FROM
                            xxxxxaaaaabbbbb
                    )
                WHEN k = 'min' THEN
                    (
                        SELECT
                            min(num)
                        FROM
                            xxxxxaaaaabbbbb
                    )
                END
            ) INTO x;
        drop table xxxxxaaaaabbbbb;
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
