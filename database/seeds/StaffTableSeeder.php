<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Staff;

class StaffTableSeeder extends Seeder
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
                'verification_no' => 'N225229892',
                'user_id' => '16',
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_id' => 2,
                'staff_surname' => 'MBAEBIE',
                'staff_first_name' => 'PAULCOLLINS',
                'staff_middle_name' => '',
                'staff_phone' => '08068535539',
                'staff_email' => 'pcollinso@yahoo.com',
                'staff_passport' => '1/N225229892.jpg',
                'gender_id' => 2,
                'qualf_id' => 2,
                'username' => 'mbaebie.paulcollins',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => 'YfwpQCmwPGcy5F2NK7wAnQEu8gloFX02dAco8YmSXPKeqAvowBhZpne31DfogM2LiSmVQ02+1T00pQHio957b9eVKrMDcj0tMqVCM+0Y51CXHJwnNlPbXrpnvvmFKhbE',
                'first_login' => 2,
                'email_link' => '3c8a7ddfc026e38ec5bdf8ff7fad9fe5',
                'email_validated' => 0,
                'phone_validated' => 1,
                'email_validated_on' => '2018-08-13 07:08:40',
                'active' => 1,
                'biometric_status' => 0,
                'is_password_reset' => 0,
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
                'staff_type_id' => 1,
            ],
            [
                'id' => 8,
                'verification_no' => 'N288829892',
                'user_id' => '0',
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_id' => 2,
                'staff_surname' => 'TIM',
                'staff_first_name' => 'OKERE',
                'staff_middle_name' => 'EGBO',
                'staff_phone' => '08068535530',
                'staff_email' => 'tim@yahoo.com',
                'staff_passport' => '1/N288829892.jpg',
                'gender_id' => 2,
                'qualf_id' => 2,
                'username' => 'tim.okere',
                'user_password' => '0',
                'temp_password' => 'YfwpQCmwPGcy5F2NK7wAnQEu8gloFX02dAco8YmSXPKeqAvowBhZpne31DfogM2LiSmVQ02+1T00pQHio957b9eVKrMDcj0tMqVCM+0Y51CXHJwnNlPbXrpnvvmFKhbE',
                'first_login' => 2,
                'email_link' => '3c8a7ddfc026e38ec5bdf8ff7fad9fe5',
                'email_validated' => 0,
                'phone_validated' => 1,
                'email_validated_on' => '2018-08-13 07:08:40',
                'active' => 1,
                'biometric_status' => 0,
                'is_password_reset' => 0,
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
                'staff_type_id' => 1,
            ],
            [
                'id' => 9,
                'verification_no' => 'N288829092',
                'user_id' => '0',
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_id' => 2,
                'staff_surname' => 'ZARA',
                'staff_first_name' => 'YURI',
                'staff_middle_name' => 'AISHA',
                'staff_phone' => '07068535530',
                'staff_email' => 'zara@yahoo.com',
                'staff_passport' => '1/N288829092.jpg',
                'gender_id' => 2,
                'qualf_id' => 2,
                'username' => 'tim.okere',
                'user_password' => '0',
                'temp_password' => 'YfwpQCmwPGcy5F2NK7wAnQEu8gloFX02dAco8YmSXPKeqAvowBhZpne31DfogM2LiSmVQ02+1T00pQHio957b9eVKrMDcj0tMqVCM+0Y51CXHJwnNlPbXrpnvvmFKhbE',
                'first_login' => 2,
                'email_link' => '3c8a7ddfc026e38ec5bdf8ff7fad9fe5',
                'email_validated' => 0,
                'phone_validated' => 1,
                'email_validated_on' => '2018-08-13 07:08:40',
                'active' => 1,
                'biometric_status' => 0,
                'is_password_reset' => 0,
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
                'staff_type_id' => 1,
            ],
            [
                'id' => 11,
                'verification_no' => 'N118828792',
                'user_id' => '0',
                'institution_id' => 1,
                'programme_id' => 1,
                'faculty_id' => 1,
                'department_id' => 3,
                'staff_surname' => 'ANGEL',
                'staff_first_name' => 'OLANIYI',
                'staff_middle_name' => 'FUMI',
                'staff_phone' => '09068535530',
                'staff_email' => 'angel@yahoo.com',
                'staff_passport' => '1/N118828792.jpg',
                'gender_id' => 2,
                'qualf_id' => 2,
                'username' => 'tim.okere',
                'user_password' => '0',
                'temp_password' => 'YfwpQCmwPGcy5F2NK7wAnQEu8gloFX02dAco8YmSXPKeqAvowBhZpne31DfogM2LiSmVQ02+1T00pQHio957b9eVKrMDcj0tMqVCM+0Y51CXHJwnNlPbXrpnvvmFKhbE',
                'first_login' => 2,
                'email_link' => '3c8a7ddfc026e38ec5bdf8ff7fad9fe5',
                'email_validated' => 0,
                'phone_validated' => 1,
                'email_validated_on' => '2018-08-13 07:08:40',
                'active' => 1,
                'biometric_status' => 0,
                'is_password_reset' => 0,
                'entered_by' => '16',
                'last_modified_by' => '16',
                'status' => 1,
                'staff_type_id' => 1,
            ]
        ];

        DB::table('sch_staff')->insert($data);

        Staff::find(7)
            ->roles()
            ->attach(Role::where('name', 'staff')->first());
    }
}
