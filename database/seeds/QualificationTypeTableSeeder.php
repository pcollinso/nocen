<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationTypeTableSeeder extends Seeder
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
                'id' => 7,
                'type' => 'Professional/Other Qualification'
            ],
            [
                'id' => 8,
                'type' => 'College'
            ],
            [
                'id' => 9,
                'type' => 'Secondary/Technical School'
            ],
            [
                'id' => 10,
                'type' => 'Primary Education'
            ],
            [
                'id' => 11,
                'type' => 'University'
            ],
            [
                'id' => 12,
                'type' => 'Polytechnic'
            ]
        ];

        DB::table('sup_qualification_type')->insert($data);
    }
}
