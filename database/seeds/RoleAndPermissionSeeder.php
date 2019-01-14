<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    private $superAdmin;
    private $instAdmin;
    private $user;
    private $staff;
    private $student;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedRoles();
        $this->seedPermissions();
    }

    public function seedRoles()
    {
        $this->superAdmin = new Role();
        $this->superAdmin->id = 1;
        $this->superAdmin->name = 'superadmin';
        $this->superAdmin->save();

        $this->instAdmin = new Role();
        $this->instAdmin->id = 2;
        $this->instAdmin->name = 'institutionadmin';
        $this->instAdmin->save();

        $this->user = new Role();
        $this->user->id = 3;
        $this->user->name = 'user';
        $this->user->save();

        $this->staff = new Role();
        $this->staff->id = 4;
        $this->staff->name = 'staff';
        $this->staff->save();

        $this->student = new Role();
        $this->student->id = 5;
        $this->student->name = 'student';
        $this->student->save();
    }

    public function seedPermissions()
    {
        $createInstitution = new Permission();
        $createInstitution->name = 'institution:create';
        $createInstitution->save();
        $createInstitution->roles()->attach($this->superAdmin);

        $listInstitutions = new Permission();
        $listInstitutions->name = 'institution:list';
        $listInstitutions->save();
        $listInstitutions->roles()->attach($this->superAdmin);

        $createInstitutionAdmin = new Permission();
        $createInstitutionAdmin->name = 'institution-admin:create';
        $createInstitutionAdmin->save();
        $createInstitutionAdmin->roles()->attach($this->superAdmin);

        $listInstitutionAdmins = new Permission();
        $listInstitutionAdmins->name = 'institution-admin:list';
        $listInstitutionAdmins->save();
        $listInstitutionAdmins->roles()->attach($this->superAdmin);

        $createStaff = new Permission();
        $createStaff->name = 'staff:create';
        $createStaff->save();
        $createStaff->roles()->attach($this->instAdmin);

        $listStaff = new Permission();
        $listStaff->name = 'staff:list';
        $listStaff->save();
        $listStaff->roles()->attach($this->instAdmin);

        $createCourseAdviser = new Permission();
        $createCourseAdviser->name = 'course-adviser:create';
        $createCourseAdviser->save();
        $createCourseAdviser->roles()->attach($this->instAdmin);

        $listCourseAdviser = new Permission();
        $listCourseAdviser->name = 'course-adviser:list';
        $listCourseAdviser->save();
        $listCourseAdviser->roles()->attach($this->instAdmin);

        $createRole = new Permission();
        $createRole->name = 'role:create';
        $createRole->save();
        $createRole->roles()->attach($this->superAdmin);

        $editRole = new Permission();
        $editRole->name = 'role:edit';
        $editRole->save();
        $editRole->roles()->attach($this->superAdmin);

        $deleteRole = new Permission();
        $deleteRole->name = 'role:delete';
        $deleteRole->save();
        $deleteRole->roles()->attach($this->superAdmin);

        $listRole = new Permission();
        $listRole->name = 'role:list';
        $listRole->save();
        $listRole->roles()->attach($this->superAdmin);
        $listRole->roles()->attach($this->instAdmin);

        $assignRole = new Permission();
        $assignRole->name = 'role:assign';
        $assignRole->save();
        $assignRole->roles()->attach($this->superAdmin);
        $assignRole->roles()->attach($this->instAdmin);



        $createPermission = new Permission();
        $createPermission->name = 'permission:create';
        $createPermission->save();
        $createPermission->roles()->attach($this->superAdmin);

        $editPermission = new Permission();
        $editPermission->name = 'permission:edit';
        $editPermission->save();
        $editPermission->roles()->attach($this->superAdmin);

        $deletePermission = new Permission();
        $deletePermission->name = 'permission:delete';
        $deletePermission->save();
        $deletePermission->roles()->attach($this->superAdmin);

        $listPermission = new Permission();
        $listPermission->name = 'permission:list';
        $listPermission->save();
        $listPermission->roles()->attach($this->superAdmin);
        $listPermission->roles()->attach($this->instAdmin);

        $assignPermission = new Permission();
        $assignPermission->name = 'permission:assign';
        $assignPermission->save();
        $assignPermission->roles()->attach($this->superAdmin);
        $assignPermission->roles()->attach($this->instAdmin);
    }
}
