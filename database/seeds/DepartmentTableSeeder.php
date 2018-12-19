<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTableSeeder extends Seeder
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
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_name' => 'AAB',
                'entered_by' => 16,
                'last_modified_by' => 16,
                'status' => 1,
            ],
            [
                'id' => 3,
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_name' => 'AAB2',
                'entered_by' => 16,
                'last_modified_by' => 16,
                'status' => 1,
            ]
        ];

        DB::table('sch_department')->insert($data);
    }
}
