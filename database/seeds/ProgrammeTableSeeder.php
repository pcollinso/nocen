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
                'require_jamb' => 1,
                'require_result_check_fee' => 1,
                'require_application_fee' => 1,
                'require_acceptance_fee' => 1,
                'require_school_fee' => 1,
                'entered_by' => '13'
            ],
            [
                'id' => 2,
                'institution_id' => 1,
                'programme_name' => 'NCE',
                'require_jamb' => 1,
                'require_result_check_fee' => 1,
                'require_application_fee' => 1,
                'require_acceptance_fee' => 1,
                'require_school_fee' => 1,
                'entered_by' => '13'
            ],
            [
                'id' => 3,
                'institution_id' => 1,
                'programme_name' => 'PRE-NCE',
                'require_jamb' => 1,
                'require_result_check_fee' => 1,
                'require_application_fee' => 1,
                'require_acceptance_fee' => 1,
                'require_school_fee' => 1,
                'entered_by' => '13'
            ],
            [
                'id' => 4,
                'institution_id' => 1,
                'programme_name' => 'SANDWICH',
                'require_jamb' => 1,
                'require_result_check_fee' => 1,
                'require_application_fee' => 1,
                'require_acceptance_fee' => 1,
                'require_school_fee' => 1,
                'entered_by' => '13'
            ],
            [
                'id' => 5,
                'institution_id' => 1,
                'programme_name' => 'PART-TIME',
                'require_jamb' => 1,
                'require_result_check_fee' => 1,
                'require_application_fee' => 1,
                'require_acceptance_fee' => 1,
                'require_school_fee' => 1,
                'entered_by' => '13'
            ],
            [
                'id' => 6,
                'institution_id' => 1,
                'programme_name' => 'PDE',
                'require_jamb' => 1,
                'require_result_check_fee' => 1,
                'require_application_fee' => 1,
                'require_acceptance_fee' => 1,
                'require_school_fee' => 1,
                'entered_by' => '13'
            ]
        ];

        DB::table('sch_programme')->insert($data);
    }
}
