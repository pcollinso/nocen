<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GlobalSettingTableSeeder extends Seeder
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
                'key_name' => 'course_staff_same_department',
                'key_value' => '1',
                'status' => 1,
            ],
            [
                'key_name' => 'course_staff_same_faculty',
                'key_value' => '1',
                'status' => 1,
            ],
            [
                'key_name' => 'course_staff_same_programme',
                'key_value' => '1',
                'status' => 1,
            ],
            [
                'key_name' => 'course_staff_same_institution',
                'key_value' => '1',
                'status' => 1,
            ]
        ];

        DB::table('sys_global_settings')->insert($data);
    }
}
