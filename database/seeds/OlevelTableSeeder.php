<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OlevelTableSeeder extends Seeder
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
                'status' => 1,
            ],
            [
                'id' => 2,
                'olevel_name' => 'NECO',
                'status' => 1,
            ],
            [
                'id' => 3,
                'olevel_name' => 'NABTEB',
                'status' => 1,
            ],
            [
                'id' => 4,
                'olevel_name' => 'WAEC GCE',
                'status' => 1,
            ],
            [
                'id' => 5,
                'olevel_name' => 'NECO GCE',
                'status' => 1,
            ]
        ];

        DB::table('sch_olevel')->insert($data);
    }
}
