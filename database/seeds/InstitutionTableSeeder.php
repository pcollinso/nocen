<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionTableSeeder extends Seeder
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
                'institution_code' => 'N225',
                'institution_name' => 'NWAFOR ORIZU COLLEGE OF EDUCTAION, NSUGBE',
                'institution_type_id' => 6,
                'logo' => 'N225',
                'address' => 'NSUGBE',
                'city' => 'NSUGBE',
                'lga' => 'IDEMILI NORTH',
                'state' => 'ANAMBRA',
                'phone' => '08011111111112',
                'email' => 'support@nocen.edu.ng',
                'terminal_id' => '4922690965',
                'course_staff_same_department' => 1,
                'course_staff_same_faculty' => 1,
                'course_staff_same_programme' => 1,
                'course_staff_same_institution' => 1,
                'entered_by' => '13',
                'last_modified_by' => '13',
                'active' => 1
            ]
        ];

        DB::table('sup_institution')->insert($data);
    }
}
