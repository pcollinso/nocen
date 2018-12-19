<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
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
                'subject_name' => 'BLANK',
                'subject_code' => 'BLANK',
            ],
            [
                'id' => 2,
                'subject_name' => 'IGBO LANGUAGE',
                'subject_code' => 'IGBO',
            ],
            [
                'id' => 3,
                'subject_name' => 'MATHEMATICS',
                'subject_code' => 'MATHS',
            ],
            [
                'id' => 4,
                'subject_name' => 'PHYSICS',
                'subject_code' => 'PHYS',
            ],
            [
                'id' => 5,
                'subject_name' => 'GEOGRAPHY',
                'subject_code' => 'GEOG',
            ],
            [
                'id' => 6,
                'subject_name' => 'CHEMISTRY',
                'subject_code' => 'CHEM',
            ],
            [
                'id' => 7,
                'subject_name' => 'AGRICULTURAL SCIENCE',
                'subject_code' => 'AGRIC',
            ],
            [
                'id' => 8,
                'subject_name' => 'CHRISTIAN RELIGIOUS STUDIES',
                'subject_code' => 'CRK',
            ],
            [
                'id' => 9,
                'subject_name' => 'ECONOMICS',
                'subject_code' => 'ECONS',
            ],
            [
                'id' => 10,
                'subject_name' => 'BIOLOGY',
                'subject_code' => 'BIO',
            ],
            [
                'id' => 11,
                'subject_name' => 'LITERATURE IN ENGLISH',
                'subject_code' => 'LIT',
            ],
            [
                'id' => 12,
                'subject_name' => 'COMMERCE',
                'subject_code' => 'COMM',
            ],
            [
                'id' => 13,
                'subject_name' => 'ACCOUNTING',
                'subject_code' => 'ACC',
            ],
            [
                'id' => 14,
                'subject_name' => 'FINE ARTS',
                'subject_code' => 'FAA',
            ],
            [
                'id' => 15,
                'subject_name' => 'INTRODUCTORY TECHNOLOGY',
                'subject_code' => 'INTRO',
            ],
            [
                'id' => 16,
                'subject_name' => 'COMPUTER STUDIES',
                'subject_code' => 'COMP',
            ],
            [
                'id' => 17,
                'subject_name' => 'FRENCH LANGUAGE',
                'subject_code' => 'FRENCH',
            ],
            [
                'id' => 18,
                'subject_name' => 'YORUBA LANGUAGE',
                'subject_code' => 'YORUBA',
            ],
            [
                'id' => 19,
                'subject_name' => 'MUSIC',
                'subject_code' => 'MUSIC',
            ],
            [
                'id' => 20,
                'subject_name' => 'HISTORY',
                'subject_code' => 'HIST',
            ],
            [
                'id' => 21,
                'subject_name' => 'CIVIC EDUCATION',
                'subject_code' => 'CIVIC',
            ],
            [
                'id' => 22,
                'subject_name' => 'FURTHER MATHEMATICS',
                'subject_code' => 'FMATHS',
            ],
            [
                'id' => 23,
                'subject_name' => 'GOVERNMENT',
                'subject_code' => 'GOVT',
            ],
            [
                'id' => 24,
                'subject_name' => 'FOOD AND NUTRITION',
                'subject_code' => 'FOODNUT',
            ],
            [
                'id' => 25,
                'subject_name' => 'ENGLISH LANGUAGE',
                'subject_code' => 'ENG',
            ]
        ];

        DB::table('sch_subject')->insert($data);
    }
}
