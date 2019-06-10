<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeCheckExclusionTableSeeder extends Seeder
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
                'fee_type_id' => 1,
                'j_regno' => '12345678AB',
                'regno' => null,
                'staff_code' => null
            ],
            [
                'id' => 2,
                'fee_type_id' => 2,
                'j_regno' => '12345678AB',
                'regno' => null,
                'staff_code' => null
            ],
            [
                'id' => 3,
                'fee_type_id' => 3,
                'j_regno' => '12345678AB',
                'regno' => null,
                'staff_code' => null
            ],
            [
                'id' => 4,
                'fee_type_id' => 4,
                'j_regno' => null,
                'regno' => '201690000',
                'staff_code' => null
            ]

        ];

        DB::table('sch_fee_check_exclusion')->insert($data);
    }
}
