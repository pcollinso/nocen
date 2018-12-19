<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffCourseTableSeeder extends Seeder
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
                'id' => 4,
                'institution_id' => 1,
                'course_id' => 1,
                'staff_id' => 7,
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ],
            [
                'id' => 5,
                'institution_id' => 1,
                'course_id' => 1,
                'staff_id' => 9,
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ]
        ];

        DB::table('sch_staff_course')->insert($data);
    }
}
