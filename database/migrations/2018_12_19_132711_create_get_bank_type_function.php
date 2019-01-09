<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetBankTypeFunction extends Migration
{
    private $name = 'get_bank_type';
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
          DECLARE p,k varchar(100);
            select bank_type into @p from sup_banks where cbn_code=a;
            set @k= case when ISNULL(@p) or @p='' then 'n/a' else @p end;
            return @k;
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
