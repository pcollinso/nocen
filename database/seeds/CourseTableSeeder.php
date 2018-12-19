<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
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
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_id' => 2,
                'level_id' => 1,
                'semester_id' => 1,
                'course_student_level_id' => 4,
                'course_staff_level_id' => 1,
                'course_name' => 'INTRODUCTION TO COMPUTER',
                'course_code' => 'CS101',
                'is_general' => 0,
                'unit_load' => 3.00,
                'status' => 1,
                'entered_by' => 16,
                'last_modified_by' => 16,
            ],
            [
                'id' => 2,
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_id' => 2,
                'level_id' => 1,
                'semester_id' => 1,
                'course_student_level_id' => 4,
                'course_staff_level_id' => 2,
                'course_name' => 'INTRODUCTION TO FORENSICS',
                'course_code' => 'FOR111',
                'is_general' => 1,
                'unit_load' => 3.00,
                'status' => 1,
                'entered_by' => 16,
                'last_modified_by' => 16,
            ]
        ];

        DB::table('sch_course')->insert($data);
    }
}
