<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeTableSeeder extends Seeder
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
                'mode_name' => 'UTME',
                'status' => 1,
            ],
            [
                'id' => 2,
                'mode_name' => 'DIRECT ENTRY',
                'status' => 1,
            ],
            [
                'id' => 3,
                'mode_name' => 'DIPLOMA',
                'status' => 1,
            ]
        ];

        DB::table('sch_mode')->insert($data);
    }
}
