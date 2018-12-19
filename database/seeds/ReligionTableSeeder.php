<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionTableSeeder extends Seeder
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
                'religion_name' => 'CHRISTIANITY',
            ],
            [
                'id' => 2,
                'religion_name' => 'ISLAM',
            ]
        ];

        DB::table('sch_religion')->insert($data);
    }
}
