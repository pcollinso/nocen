<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgCoordinatorTableSeeder extends Seeder
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
                'programme_id' => 1,
                'staff_id' => 7,
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
            ]
        ];

        DB::table('sch_prog_coord')->insert($data);
    }
}
