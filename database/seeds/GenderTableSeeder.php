<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
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
                'gender_name' => 'MALE',
            ],
            [
                'id' => 2,
                'gender_name' => 'FEMALE',
            ]
        ];

        DB::table('sch_gender')->insert($data);
    }
}
