<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualfTableSeeder extends Seeder
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
                'qualf_name' => 'PROFESSOR',
                'qualf_title' => 'Prof.',
                'status' => 1,
            ],
            [
                'id' => 2,
                'qualf_name' => 'Ph.D',
                'qualf_title' => 'Dr.',
                'status' => 1,
            ],
            [
                'id' => 3,
                'qualf_name' => 'MASTERS',
                'qualf_title' => 'M.Sc',
                'status' => 1,
            ],
            [
                'id' => 4,
                'qualf_name' => 'DEGREE',
                'qualf_title' => 'B.Sc',
                'status' => 1,
            ]
        ];

        DB::table('sch_qualf')->insert($data);
    }
}
