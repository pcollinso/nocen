<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeTypeTableSeeder extends Seeder
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
                'fee_type' => 'APPLICATION_FEE'
            ],
            [
                'id' => 2,
                'fee_type' => 'POST_UTME_RESULT_CHECK_FEE'
            ],
            [
                'id' => 3,
                'fee_type' => 'ACCEPTANCE_FEE'
            ],
            [
                'id' => 4,
                'fee_type' => 'SCHOOL_FEE'
            ],
            [
                'id' => 5,
                'fee_type' => 'HOSTEL_FEE'
            ],
            [
                'id' => 6,
                'fee_type' => 'FACULTY_DUE'
            ],
            [
                'id' => 7,
                'fee_type' => 'DEPARTMENT_DUE'
            ],
            [
                'id' => 8,
                'fee_type' => 'EXAM_LEVY'
            ],
            [
                'id' => 9,
                'fee_type' => 'RESULT_CHECK_FEE'
            ],

        ];

        DB::table('sch_fee_type')->insert($data);
    }
}
