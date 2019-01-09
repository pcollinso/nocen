<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetBankIdFromNameFunction extends Migration
{
    private $name = 'get_bank_id_from_name';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(a varchar(100)) RETURNS bigint(20)
        BEGIN
          DECLARE p BIGINT(20);
            select id into p from sup_banks where bank_name=a;
        if ROW_COUNT() < 1 then set p=0;end if;
          RETURN p;
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
