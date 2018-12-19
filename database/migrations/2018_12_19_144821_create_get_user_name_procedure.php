<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGetUserNameProcedure extends Migration
{
    private $name = 'get_user_name';
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
        CREATE FUNCTION `{$this->name}`(ver_no varchar(20)) RETURNS varchar(100) CHARSET utf8
        BEGIN
          DECLARE x,p varchar(100);
        select concat(ifnull(surname,''),' ',ifnull(first_name,''),' ',ifnull(middle_name,''))nn into @x
        from hr_personal_info where verification_no=ver_no or username=ver_no;
        if @x='' or @x is null then select name into @x from sup_users where sup_users.id=ver_no or username=ver_no;end if;
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
