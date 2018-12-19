<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldTableSeeder extends Seeder
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
                'department_id' => 2,
                'field_name' => 'AAB-FIELD',
                'field_abbrv' => 'AAB_',
                'field_code' => 'AAB-CODE',
                'status' => 1,
                'entered_by' => 16,
                'last_modified_by' => 16,
            ]
        ];

        DB::table('sch_field')->insert($data);
    }
}
