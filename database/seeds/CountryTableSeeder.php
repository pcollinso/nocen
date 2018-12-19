<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
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
                'id' => 3,
                'country' => 'Nigeria',
                'abreviation' => 'NG',
                'entered_by' =>'1',
            ],
            [
                'id' => 4,
                'country' => 'Ghana',
                'abreviation' => 'GH',
                'entered_by' =>'1',
            ],
            [
                'id' => 5,
                'country' => 'Kenya',
                'abreviation' => 'KEN',
                'entered_by' =>'13',
            ]
        ];

        DB::table('sup_country')->insert($data);
    }
}
