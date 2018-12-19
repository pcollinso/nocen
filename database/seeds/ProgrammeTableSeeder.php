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
                'id' => 3,
                'institution_id' => 1,
                'programme_name' => 'NCE',
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ]
        ];

        DB::table('sch_programme')->insert($data);
    }
}
