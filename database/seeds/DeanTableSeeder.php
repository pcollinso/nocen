<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeanTableSeeder extends Seeder
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
                'id' => 6,
                'institution_id' => 1,
                'faculty_id' => 1,
                'staff_id' => 7,
                'status' => 1,
                'entered_by' => 16,
                'last_modified_by' => 16,
            ]
        ];

        DB::table('sch_dean')->insert($data);
    }
}
