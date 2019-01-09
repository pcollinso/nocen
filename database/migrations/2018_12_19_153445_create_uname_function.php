<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnameFunction extends Migration
{
    private $name = 'uname';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(`id` varchar(20)) RETURNS varchar(30) CHARSET utf8
        BEGIN
            #Routine body goes here...
        if id != '0' and id != 'system' and isNumeric(id) = 0 then return id;end if;
        if id=0 or id='system' then return 'system';end if;
        if id is not null then
        select `name` into @x from sup_users where sup_users.id = id;
        if @x='' or ISNULL(@x) then set @x = 'n/a'; end if;
        return @x;
        else
        return null;
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
