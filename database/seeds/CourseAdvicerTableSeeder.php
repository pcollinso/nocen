<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseAdvicerTableSeeder extends Seeder
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
                'id' => 2,
                'institution_id' => 1,
                'department_id' => 2,
                'level_id' => 1,
                'staff_id' => 8,
                'entered_by' => 16,
                'last_modified_by' => 16,
            ],
            [
                'id' => 5,
                'institution_id' => 1,
                'department_id' => 2,
                'level_id' => 1,
                'staff_id' => 9,
                'entered_by' => 16,
                'last_modified_by' => 16,
            ]
        ];

        DB::table('sch_course_advicer')->insert($data);
    }
}
