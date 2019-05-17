<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OlevelQualificationTableSeeder extends Seeder
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
                'olevel_name' => 'WASSCE',
            ],
            [
                'id' => 2,
                'olevel_name' => 'NECO',
            ],
            [
                'id' => 3,
                'olevel_name' => 'NABTEB',
            ],
            [
                'id' => 4,
                'olevel_name' => 'WAEC GCE',
            ],
            [
                'id' => 5,
                'olevel_name' => 'NECO GCE',
            ]
        ];

        DB::table('sch_olevel')->insert($data);
    }
}
