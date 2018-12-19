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
                'institution_type_id' => 4,
                'logo' => 'N225',
                'address' => 'NSUGBE',
                'city' => 'NSUGBE',
                'lga' => '',
                'state' => 'ANAMBRA',
                'phone' => '08011111111112',
                'email' => 'support@nocen.edu.ng',
                'employee_2wa' => 0,
                'staff_2wa' => 0,
                'entered_by' => '13',
                'last_modified_by' => '13',
                'active' => 1,
                'callback_url' => 'localhost:8080/veripay-service/accept_payment_callback.php',
            ]
        ];

        DB::table('sup_institution')->insert($data);
    }
}
