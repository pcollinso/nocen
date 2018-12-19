<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelTableSeeder extends Seeder
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
                'level_name' => '100 LEVEL',
                'level_code' => '100',
                'status' => 1,
            ],
            [
                'id' => 2,
                'level_name' => '200 LEVEL',
                'level_code' => '200',
                'status' => 1,
            ],
            [
                'id' => 3,
                'level_name' => '300 LEVEL',
                'level_code' => '300',
                'status' => 1,
            ],
            [
                'id' => 4,
                'level_name' => '400 LEVEL',
                'level_code' => '400',
                'status' => 1,
            ],
            [
                'id' => 5,
                'level_name' => '500 LEVEL',
                'level_code' => '500',
                'status' => 1,
            ],
            [
                'id' => 6,
                'level_name' => '600 LEVEL',
                'level_code' => '600',
                'status' => 1,
            ]
        ];

        DB::table('sch_level')->insert($data);
    }
}
