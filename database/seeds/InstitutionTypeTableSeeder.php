<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionTypeTableSeeder extends Seeder
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
                'institution_type' => 'PRIMARY',
            ],
            [
                'id' => 2,
                'institution_type' => 'SECONDARY',
            ],
            [
                'id' => 3,
                'institution_type' => 'UNDERGRADUATE',
            ],
            [
                'id' => 4,
                'institution_type' => 'POSTGRADUATE',
            ],
            [
                'id' => 5,
                'institution_type' => 'DOCTORATE',
            ],
            [
                'id' => 6,
                'institution_type' => 'HIGHER INSTITUTION',
            ]
        ];

        DB::table('sch_institution_type')->insert($data);
    }
}
