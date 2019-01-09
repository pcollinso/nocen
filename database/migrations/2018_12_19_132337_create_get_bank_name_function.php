<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetBankNameFunction extends Migration
{
    private $name = 'get_bank_name';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<EOD
        DROP FUNCTION IF EXISTS `{$this->name}`;
        CREATE FUNCTION `{$this->name}`(`bank_cbn_code` varchar(50)) RETURNS varchar(200) CHARSET utf8
        BEGIN
        declare x,y VARCHAR(20);
        select case when (SELECT bank_name FROM sup_banks WHERE cbn_code=bank_cbn_code) is null then
        (SELECT bank_name FROM sup_banks WHERE id=bank_cbn_code) else (SELECT bank_name FROM sup_banks WHERE cbn_code=bank_cbn_code)
        end INTO @x;
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
