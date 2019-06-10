<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeTableSeeder extends Seeder
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
                'payment_type' => 'FULL_PAYMENT'
            ],
            [
                'id' => 2,
                'payment_type' => 'FIRST_PAYMENT'
            ],
            [
                'id' => 3,
                'payment_type' => 'FINAL_PAYMENT'
            ],

        ];

        DB::table('sys_payment_type')->insert($data);
    }
}
