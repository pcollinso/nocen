<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamOfficerTableSeeder extends Seeder
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
                'id' => 5,
                'institution_id' => 1,
                'staff_id' => 7,
                'department_id' => 2,
                'entered_by' => 16,
                'last_modified_by' => 16,
                'status' => 1,
            ]
        ];

        DB::table('sch_exam_officer')->insert($data);
    }
}
