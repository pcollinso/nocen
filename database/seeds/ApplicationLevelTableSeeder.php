<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationLevelTableSeeder extends Seeder
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
                'application_level' => 'UTME'
            ],
            [
                'id' => 2,
                'application_level' => 'MATRIC'
            ],
            [
                'id' => 3,
                'application_level' => 'FIELD'
            ],
            [
                'id' => 4,
                'application_level' => 'FIELD_LEVEL'
            ],
            [
                'id' => 5,
                'application_level' => 'DEPARTMENT'
            ],
            [
                'id' => 6,
                'application_level' => 'DEPARTMENT_LEVEL'
            ],
            [
                'id' => 7,
                'application_level' => 'FACULTY'
            ],
            [
                'id' => 8,
                'application_level' => 'FACULTY_LEVEL'
            ],
            [
                'id' => 9,
                'application_level' => 'PROGRAMME'
            ],
            [
                'id' => 10,
                'application_level' => 'PROGRAMME_LEVEL'
            ],
            [
                'id' => 11,
                'application_level' => 'INSTITUTION'
            ],
            [
                'id' => 12,
                'application_level' => 'INSTITUTION_LEVEL'
            ],

        ];

        DB::table('sys_application_level')->insert($data);
    }
}
