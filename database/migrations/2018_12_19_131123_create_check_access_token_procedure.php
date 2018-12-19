<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCheckAccessTokenProcedure extends Migration
{
    private $name = 'check_access_token';
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
        CREATE FUNCTION `{$this->name}`() RETURNS int(11)
        BEGIN

        DECLARE v_finished INTEGER DEFAULT 0;
        DECLARE tokendate date ;

        -- declare cursor for access token
        DEClARE access_cursor CURSOR FOR
        SELECT date FROM _access_token;

        -- declare NOT FOUND handler
        DECLARE CONTINUE HANDLER
                FOR NOT FOUND SET v_finished = 1;

        OPEN access_cursor;

        get_tokens: LOOP

        FETCH access_cursor INTO tokendate;

        IF v_finished = 1 THEN
        LEAVE get_tokens;
        END IF;

        -- remove expired tokens
        if(DATEDIFF(date(now()),date(tokendate))>0) then
        Delete FROM _access_token where DATEDIFF(date(now()),date(tokendate)) != 0 ;
        end if;
        END LOOP get_tokens;

        CLOSE access_cursor;

        return 0;


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
