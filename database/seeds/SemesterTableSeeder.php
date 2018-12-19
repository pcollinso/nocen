<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterTableSeeder extends Seeder
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
                'semester_name' => 'First Semester',
                'status' => 1,
            ],
            [
                'id' => 2,
                'semester_name' => 'Second Semester',
                'status' => 1,
            ],
            [
                'id' => 3,
                'semester_name' => 'Third Semester',
                'status' => 1,
            ]
        ];

        DB::table('sch_semester')->insert($data);
    }
}
