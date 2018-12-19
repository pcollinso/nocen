<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralCourseTableSeeder extends Seeder
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
                'institution_id' => 1,
                'course_id' => 3,
                'department_id' => 2,
                'level_id' => 1,
                'semester_id' => 1,
            ]
        ];

        DB::table('sch_general_course')->insert($data);
    }
}
