<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchTableSeeder extends Seeder
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
                'batch_year' => '2010',
                'batch_name' => '2010/2011'
            ],
            [
                'id' => 2,
                'batch_year' => '2011',
                'batch_name' => '2011/2012'
            ],
            [
                'id' => 3,
                'batch_year' => '2012',
                'batch_name' => '2012/2013'
            ],
            [
                'id' => 4,
                'batch_year' => '2013',
                'batch_name' => '2013/2014'
            ],
            [
                'id' => 5,
                'batch_year' => '2014',
                'batch_name' => '2014/2015'
            ],
            [
                'id' => 6,
                'batch_year' => '2015',
                'batch_name' => '2015/2016'
            ],
            [
                'id' => 7,
                'batch_year' => '2016',
                'batch_name' => '2016/2017'
            ]
        ];

        DB::table('sch_batch')->insert($data);
    }
}
