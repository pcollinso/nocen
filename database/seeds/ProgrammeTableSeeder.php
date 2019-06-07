<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgrammeTableSeeder extends Seeder
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
                'programme_name' => 'DEGREE',
                'entered_by' => '13',
                'last_modified_by' => '13',
                'status' => 1,
            ],
            [
                'id' => 2,
                'institution_id' => 1,
                'programme_name' => 'NCE',
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ],
            [
                'id' => 3,
                'institution_id' => 1,
                'programme_name' => 'PRE-NCE',
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ],
            [
                'id' => 4,
                'institution_id' => 1,
                'programme_name' => 'SANDWICH',
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ],
            [
                'id' => 5,
                'institution_id' => 1,
                'programme_name' => 'PART-TIME',
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ],
            [
                'id' => 6,
                'institution_id' => 1,
                'programme_name' => 'VOC',
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ]
        ];

        DB::table('sch_programme')->insert($data);
    }
}
