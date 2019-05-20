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
    }
}
