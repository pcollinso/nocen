<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeOTableSeeder extends Seeder
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
                'grade_name' => 'A1',
            ],
            [
                'id' => 2,
                'grade_name' => 'B2',
            ],
            [
                'id' => 3,
                'grade_name' => 'B3',
            ],
            [
                'id' => 4,
                'grade_name' => 'C4',
            ],
            [
                'id' => 5,
                'grade_name' => 'C5',
            ],
            [
                'id' => 6,
                'grade_name' => 'C6',
            ],
            [
                'id' => 7,
                'grade_name' => 'D7',
            ],
            [
                'id' => 8,
                'grade_name' => 'E8',
            ],
            [
                'id' => 9,
                'grade_name' => 'F9',
            ]
        ];

        DB::table('sch_grade_o')->insert($data);
    }
}
