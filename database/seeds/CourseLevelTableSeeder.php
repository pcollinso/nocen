<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseLevelTableSeeder extends Seeder
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
                'course_level_name' => 'DEPARTMENT',
            ],
            [
                'id' => 2,
                'course_level_name' => 'FACULTY',
            ],
            [
                'id' => 3,
                'course_level_name' => 'PROGRAMME',
            ],
            [
                'id' => 4,
                'course_level_name' => 'INSTITUTION',
            ],
            [
                'id' => 5,
                'course_level_name' => 'PROJECT',
            ]
        ];

        DB::table('sch_course_level')->insert($data);
    }
}
