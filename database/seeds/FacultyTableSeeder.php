<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultyTableSeeder extends Seeder
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
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_name' => 'Arts and Social Sciences',
                'status' => 1,
            ],
            [
                'id' => 2,
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_name' => 'Education',
                'status' => 1,
            ],
            [
                'id' => 3,
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_name' => 'Languages',
                'status' => 1,
            ],
            [
                'id' => 4,
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_name' => 'Sciences',
                'status' => 1,
            ],
            [
                'id' => 5,
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_name' => 'Vocational and Technical Education',
                'status' => 1,
            ],
            [
                'id' => 6,
                'institution_id' => 1,
                'programme_id' => 2,
                'faculty_name' => 'Arts and Social Sciences',
                'status' => 1,
            ],
            [
                'id' => 7,
                'institution_id' => 1,
                'programme_id' => 2,
                'faculty_name' => 'EARLY CHILDHOOD CARE EDUCATION',
                'status' => 1,
            ],
            [
                'id' => 8,
                'institution_id' => 1,
                'programme_id' => 2,
                'faculty_name' => 'Languages',
                'status' => 1,
            ],
            [
                'id' => 9,
                'institution_id' => 1,
                'programme_id' => 2,
                'faculty_name' => 'Sciences',
                'status' => 1,
            ],
            [
                'id' => 10,
                'institution_id' => 1,
                'programme_id' => 2,
                'faculty_name' => 'Vocational and Technical Education',
                'status' => 1,
            ],
            [
                'id' => 11,
                'institution_id' => 1,
                'programme_id' => 3,
                'faculty_name' => 'Arts and Social Sciences',
                'status' => 1,
            ],
            [
                'id' => 12,
                'institution_id' => 1,
                'programme_id' => 3,
                'faculty_name' => 'EARLY CHILDHOOD CARE EDUCATION',
                'status' => 1,
            ],
            [
                'id' => 13,
                'institution_id' => 1,
                'programme_id' => 3,
                'faculty_name' => 'Languages',
                'status' => 1,
            ],
            [
                'id' => 14,
                'institution_id' => 1,
                'programme_id' => 3,
                'faculty_name' => 'Sciences',
                'status' => 1,
            ],
            [
                'id' => 15,
                'institution_id' => 1,
                'programme_id' => 3,
                'faculty_name' => 'Vocational and Technical Education',
                'status' => 1,
            ],
            [
                'id' => 16,
                'institution_id' => 1,
                'programme_id' => 4,
                'faculty_name' => 'Arts and Social Sciences',
                'status' => 1,
            ],
            [
                'id' => 17,
                'institution_id' => 1,
                'programme_id' => 4,
                'faculty_name' => 'Education',
                'status' => 1,
            ],
            [
                'id' => 18,
                'institution_id' => 1,
                'programme_id' => 4,
                'faculty_name' => 'Languages',
                'status' => 1,
            ],
            [
                'id' => 19,
                'institution_id' => 1,
                'programme_id' => 4,
                'faculty_name' => 'Sciences',
                'status' => 1,
            ],
            [
                'id' => 20,
                'institution_id' => 1,
                'programme_id' => 4,
                'faculty_name' => 'Vocational and Technical Education',
                'status' => 1,
            ],
            [
                'id' => 21,
                'institution_id' => 1,
                'programme_id' => 5,
                'faculty_name' => 'professional diploma',
                'status' => 1,
            ],
            [
                'id' => 22,
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_name' => 'EARLY CHILDHOOD CARE EDUCATION',
                'status' => 1,
            ],
            [
                'id' => 23,
                'institution_id' => 1,
                'programme_id' => 6,
                'faculty_name' => 'PRE-NCE',
                'status' => 1,
            ]
        ];

        DB::table('sch_faculty')->insert($data);
    }
}
