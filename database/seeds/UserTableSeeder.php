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
                'username' => 'support.nocen',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => 'unC9/9pG0vVzx851cl/bhT4qIZWdask1MK0bDDr45fEaAi5sQMBznfdlxt0sILb4XU2elwTZXEsg6m29CYsH1uziUNpM9gaM7HXUMAEhS9eBa6IgZFDuNCJjhuHGzLRC',
                'password_expiry_date' => '2019-03-14',
                'name' => 'Super Admin',
                'email' => 'support@nocen.edu.ng',
                'phone' => '08068535539',
                'institution_id' => '0',
                'module_id' => '1',
                'user_group_id' => '2',
                'status' => '1',
                'entered_by' => '13',
                'last_modified_by' => null,
                'is_student' => '0',
                'is_staff' => '0',
                'staff_code' => null,
                'regno' => null
            ],
            [
                'id' => 15,
                'username' => 'admin.nocen',
                'user_password' => 'ba16926613bca60629dcdd93bb567a43',
                'temp_password' => '74vCT/Tt7tmcAqnr3KR1jvSwaQc6Nu5JzHVqO+fHNsYiXvWxorAm4SJsemagvmjdrNgz4LD+DmDVf2t6oR4ZGJGFBjd0kIxAUCnm31a2lAXXWossufXOPsmMLn7mPblg',
                'password_expiry_date' => '2019-03-15',
                'name' => 'NOCEN ADMIN',
                'email' => 'admin@nocen.edu.ng',
                'phone' => '080685355390',
                'institution_id' => 1,
                'module_id' => '1',
                'user_group_id' => '3',
                'status' => '1',
                'entered_by' => '13',
                'last_modified_by' => null,
                'is_student' => '0',
                'is_staff' => '0',
                'staff_code' => null,
                'regno' => null
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
