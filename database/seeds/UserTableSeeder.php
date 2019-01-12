<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
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
                'id' => 13,
                'username' => 'support@appmartgroup.com',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => 'unC9/9pG0vVzx851cl/bhT4qIZWdask1MK0bDDr45fEaAi5sQMBznfdlxt0sILb4XU2elwTZXEsg6m29CYsH1uziUNpM9gaM7HXUMAEhS9eBa6IgZFDuNCJjhuHGzLRC',
                'password_expiry_date' => '2019-03-14',
                'name' => 'Super Admin',
                'email' => 'support@appmartgroup.com',
                'phone' => '08176655558',
                'institution_id' => '0',
                'module_id' => '1',
                'user_group_id' => '2',
                'status' => '1',
                'entered_by' => '1',
                'last_modified_by' => null,
                'first_login' => '2',
                'hash_code_sent_on' => '2017-07-04 12:57:30',
                'is_student' => '0',
                'is_staff' => '0',
                'email_link' => '',
                'staff_code' => null,
                'email_validated' => '1',
                'phone_validated' => '1',
                'email_validated_on' => '2017-06-29 20:55:56',
                'phone_validated_on' => '2017-06-29 20:55:56',
                'is_password_reset' => '0',
            ],
            [
                'id' => 15,
                'username' => 'umejiofor.anthony.chinedu',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => '74vCT/Tt7tmcAqnr3KR1jvSwaQc6Nu5JzHVqO+fHNsYiXvWxorAm4SJsemagvmjdrNgz4LD+DmDVf2t6oR4ZGJGFBjd0kIxAUCnm31a2lAXXWossufXOPsmMLn7mPblg',
                'password_expiry_date' => '2019-03-15',
                'name' => 'UMEJIOFOR ANTHONY CHINEDU',
                'email' => 'tony@appmartgroup.com',
                'phone' => '08037957323',
                'institution_id' => '0',
                'module_id' => '1',
                'user_group_id' => '3',
                'status' => '1',
                'entered_by' => '13',
                'last_modified_by' => '13',
                'first_login' => '2',
                'hash_code_sent_on' => '2018-08-13 05:58:58',
                'is_student' => '0',
                'is_staff' => '1',
                'email_link' => '2abd1fbaeb089ec1938f7af51e1696bc',
                'staff_code' => 'G232452842',
                'email_validated' => '0',
                'phone_validated' => '1',
                'phone_validated_on' => '2018-08-13 05:59:25',
                'email_validated_on' => null,
                'is_password_reset' => '0',
            ],
            [
                'id' => 16,
                'username' => 'mbaebie.paulcollins',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => 'iiUEDv9Aq5UiLjrby4Bj+/qjreqERVjQX2tnXMLHATASM8Wf4Tk715uogcJPOrJ2UkTpMzCiKpLUveblKCOIUs3navPoiTyAaa7CWmeRAynLVpMuPOq7j8VcyO+zknVo',
                'password_expiry_date' => '2019-03-14',
                'name' => 'MBAEBIE PAULCOLLINS',
                'email' => 'pcollinso@yahoo.com',
                'phone' => '08068535539',
                'institution_id' => '1',
                'module_id' => '1',
                'user_group_id' => '4',
                'status' => '1',
                'entered_by' => '15',
                'last_modified_by' => null,
                'first_login' => '2',
                'hash_code_sent_on' => '2018-08-13 07:31:50',
                'is_student' => '0',
                'is_staff' => '1',
                'email_link' => '3c8a7ddfc026e38ec5bdf8ff7fad9fe5',
                'staff_code' => '54556565621',
                'email_validated' => '0',
                'phone_validated' => '1',
                'phone_validated_on' => '2018-08-13 07:08:40',
                'email_validated_on' => null,
                'is_password_reset' => '0',
            ],
            [
                'id' => 17,
                'username' => 'omen.agha.stanistus',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => '1jt44MLK96qnP0hxxn+h6cOObEq9d+C6NrsFgTYV8gKiughk9DkEo2V3G4sSulOdBG+fLCBC0GudRMBY/fwvHimdGMOIw94lYtmxUI9F/+A3Agj0CbqY/GqcMtEgCIQy',
                'password_expiry_date' => '2019-03-15',
                'name' => 'omen agha stanistus',
                'email' => 'emmanuel.aghadinuno@appmartgroup.com',
                'phone' => '07068535539',
                'institution_id' => '1',
                'module_id' => '2',
                'user_group_id' => '5',
                'status' => '1',
                'entered_by' => '16',
                'last_modified_by' => '16',
                'first_login' => '2',
                'hash_code_sent_on' => '2018-08-13 14:42:43',
                'is_student' => '0',
                'is_staff' => '1',
                'email_link' => 'c6f8f9655cc334bc3b24752a1bc55437',
                'staff_code' => '5453543322',
                'email_validated' => '0',
                'phone_validated' => '1',
                'phone_validated_on' => '2018-08-13 14:43:00',
                'email_validated_on' => null,
                'is_password_reset' => '0',
            ]
        ];

        DB::table('sup_users')->insert($data);
        $superAdminRole = Role::where('name', 'superadmin')->first();
        $user = User::find(13);
        $user->roles()->attach($superAdminRole);
        $user->permissions()->attach($superAdminRole->permissions()->get());

    }
}
