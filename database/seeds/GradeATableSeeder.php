<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeATableSeeder extends Seeder
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
                'grade_name' => 'A',
                'grade_range' => 70,
                'point_for_1' => 5,
                'point_for_2' => 10,
                'point_for_3' => 15,
                'point_for_4' => 20,
                'point_for_5' => 25,
                'point_for_6' => 30,
                'point_for_7' => 35,
                'remark' => 'EXCELLENT',
                'pass_status' => 'PASSED',
            ],
            [
                'id' => 2,
                'grade_name' => 'B',
                'grade_range' => 60,
                'point_for_1' => 4,
                'point_for_2' => 8,
                'point_for_3' => 12,
                'point_for_4' => 16,
                'point_for_5' => 20,
                'point_for_6' => 24,
                'point_for_7' => 28,
                'remark' => 'GOOD',
                'pass_status' => 'PASSED',
            ],
            [
                'id' => 3,
                'grade_name' => 'C',
                'grade_range' => 55,
                'point_for_1' => 3,
                'point_for_2' => 6,
                'point_for_3' => 9,
                'point_for_4' => 12,
                'point_for_5' => 15,
                'point_for_6' => 18,
                'point_for_7' => 21,
                'remark' => 'CREDIT',
                'pass_status' => 'PASSED',
            ],
            [
                'id' => 4,
                'grade_name' => 'D',
                'grade_range' => 50,
                'point_for_1' => 2,
                'point_for_2' => 4,
                'point_for_3' => 6,
                'point_for_4' => 8,
                'point_for_5' => 10,
                'point_for_6' => 12,
                'point_for_7' => 14,
                'remark' => 'PASS',
                'pass_status' => 'PASSED',
            ],
            [
                'id' => 5,
                'grade_name' => 'E',
                'grade_range' => 45,
                'point_for_1' => 1,
                'point_for_2' => 2,
                'point_for_3' => 3,
                'point_for_4' => 4,
                'point_for_5' => 5,
                'point_for_6' => 6,
                'point_for_7' => 7,
                'remark' => 'WEAK PASS',
                'pass_status' => 'PASSED',
            ],
            [
                'id' => 6,
                'grade_name' => 'F',
                'grade_range' => 0,
                'point_for_1' => 0,
                'point_for_2' => 0,
                'point_for_3' => 0,
                'point_for_4' => 0,
                'point_for_5' => 0,
                'point_for_6' => 0,
                'point_for_7' => 0,
                'remark' => 'FAIL',
                'pass_status' => 'FAILED',
            ]
        ];

        DB::table('sch_grade_a')->insert($data);
    }
}
