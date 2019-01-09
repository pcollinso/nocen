<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetBankNameFromIdFunction extends Migration
{
    private $name = 'get_bank_name_from_ID';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(a varchar(10)) RETURNS varchar(100) CHARSET utf8
        BEGIN
          DECLARE p varchar(100);
            if a=0 or a is null or a="" then set @p='n/a';
            else
            select bank_name into @p from sup_banks where id=a;
            end if;
            if ROW_COUNT() < 1 or @p is null or @p="" then set @p='n/a';
            END IF;
          RETURN @p;
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
