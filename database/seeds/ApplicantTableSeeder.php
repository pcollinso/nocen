<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;

class ApplicantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'institution_id' => 1,
            'application_code' => '1234567890',
            'field_id' => 2,
            'gender_id' => 1,
            'nationality_id' => 3,
            'state_id' => 1,
            'lga_id' => 1,
            'religion_id' => 1,
            'town_id' => 2,
            'j_regno' => 44332211,
            'surname' => 'JONES',
            'first_name' => 'MICHAEL',
            'phone' => '09091112222',
            'email' => 'test@applicant.com',
            'dob' => '2000-05-01',
            'user_password' => 'da0feea11db421a7be1173895497e71f',
            'passport' => '08WZImx6tKeaszVNRRlWTEoGlZxlYfC64lvvcvmk.jpeg',
        ];

        $applicant = Applicant::createApplicant($data);

        $data = [
            [
                'institution_id' => 1,
                'application_id' => $applicant->id,
                'surname' => 'JONES',
                'first_name' => 'JAMES',
                'middle_name' => null,
                'relationship_id' => 2,
                'gender_id' => 2,
            ],
            [
                'institution_id' => 1,
                'application_id' => $applicant->id,
                'surname' => 'JONES',
                'first_name' => 'MARIAM',
                'middle_name' => 'MARY',
                'relationship_id' => 1,
                'gender_id' => 2,
            ]
        ];

        DB::table('sch_application_nof')->insert($data);

        $data = [
            [
                'institution_id' => 1,
                'application_id' => $applicant->id,
                'exam_school' => 'TEST SCHOOL',
                'olevel_id' => 1,
                'year' => 2019,
                'exam_reg' => '12345',
                'sub1' => 2,
                'sub2' => 3,
                'sub3' => 9,
                'sub4' => 25,
                'sub5' => 7,
                'sub6' => 13,
                'sub7' => 4,
                'sub8' => 6,
                'sub9' => 5,
                'gd1' => 2,
                'gd2' => 3,
                'gd3' => 3,
                'gd4' => 2,
                'gd5' => 2,
                'gd6' => 2,
                'gd7' => 2,
                'gd8' => 2,
                'gd9' => 2,
                'status' => 1,
            ],
            [
                'institution_id' => 1,
                'application_id' => $applicant->id,
                'exam_school' => 'TEST SCHOOL',
                'olevel_id' => 1,
                'year' => 2019,
                'exam_reg' => '54321',
                'sub1' => 2,
                'sub2' => 3,
                'sub3' => 4,
                'sub4' => 5,
                'sub5' => 6,
                'sub6' => 7,
                'sub7' => 10,
                'sub8' => 8,
                'sub9' => 25,
                'gd1' => 1,
                'gd2' => 1,
                'gd3' => 1,
                'gd4' => 1,
                'gd5' => 1,
                'gd6' => 1,
                'gd7' => 1,
                'gd8' => 1,
                'gd9' => 1,
                'status' => 1,
            ]
        ];

        DB::table('sch_application_qualf')->insert($data);

        $data = [
            [
                'institution_id' => 1,
                'application_id' => $applicant->id,
                'year' => 2019,
                'sub1' => 3,
                'sub2' => 4,
                'sub3' => 25,
                'sub4' => 6,
                'score1' => 80,
                'score2' => 80,
                'score3' => 80,
                'score4' => 80
            ]
        ];

        DB::table('sch_application_utme')->insert($data);
    }
}
