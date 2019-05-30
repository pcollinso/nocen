<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
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
                'username' => 'umejiofor.anthony',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => '74vCT/Tt7tmcAqnr3KR1jvSwaQc6Nu5JzHVqO+fHNsYiXvWxorAm4SJsemagvmjdrNgz4LD+DmDVf2t6oR4ZGJGFBjd0kIxAUCnm31a2lAXXWossufXOPsmMLn7mPblg',
                'password_expiry_date' => '2019-03-15',
                'name' => 'UMEJIOFOR ANTHONY',
                'email' => 'tony@appmartgroup.com',
                'phone' => '08037957323',
                'institution_id' => 1,
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
            ]
        ];

        DB::table('sup_users')->insert($data);
        $superAdminRole = Role::where('name', 'superadmin')->first();
        $instAdminRole = Role::where('name', 'institutionadmin')->first();
        $superAdmin = User::find(13);
        $instAdmin = User::find(15);
        $superAdmin->roles()->attach($superAdminRole);
        $superAdmin->permissions()->attach($superAdminRole->permissions()->get());
        $instAdmin->roles()->attach($instAdminRole);
        $instAdmin->permissions()->attach($instAdminRole->permissions()->get());

        $applicationReviewPermission = Permission::where('name', 'application:review')->first();
        $instAdmin->permissions()->attach($applicationReviewPermission);

    }
}
