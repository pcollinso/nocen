<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'fee_id' => 1,
                'payment_type_id' => 1,
                'institution_id' => 1,
                'level_id' => null,
                'j_regno' => '87654321AB',
                'regno' => null,
                'amount' => 2250,
                'confirmation_no' => '07025701271537524516863',
                'receipt_no' => 'FRE-1243434',
                'terminal_id' => '7009158828'
            ]
        ];

        DB::table('sch_payment')->insert($data);
    }
}
