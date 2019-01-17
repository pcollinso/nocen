<script>
    const sidebarMenu = [
        { path: '#', icon: 'fa fa-th', title: 'Create/setup institution',
            roles: ['superadmin'],
            children: [
                { path: '/s/institutions', title: 'List institutions', roles: ['superadmin'] }
            ]
        },
        { path: '#', icon: 'fa fa-th', title: 'Manage institution admins',
            roles: ['superadmin'],
            children: [
                { path: '/s/institution-admins', title: 'List institution admins', roles: ['superadmin'] }
            ]
        },
        { path: '#', icon: 'fa fa-th', title: 'Manage roles and permissions',
            roles: ['superadmin'],
            children: [
                { path: '/s/roles', title: 'Roles', roles: ['superadmin'] },
                { path: '/s/permissions', title: 'Permissions', roles: ['superadmin'] },
                { path: '/s/roles/default-permissions', title: 'Default permissions', roles: ['superadmin'] }
            ]
        },
        { path: '#', icon: 'fa fa-wrench', title: 'School Setup',
            roles: ['institutionadmin'],
            children: [
                { path: '/i/setup/programme', title: 'Programme Listing', roles: ['institutionadmin']},
                { path: '/i/setup/faculty', title: 'Faculty Listing', roles: ['institutionadmin'] },
                { path: '/i/setup/department', title: 'Department Listing', roles: ['institutionadmin'] },
                { path: '/i/setup/field', title: 'Field Listing', roles: ['institutionadmin'] },
                { path: '/i/setup/course', title: 'Course Listing', roles: ['institutionadmin'] }
            ]
        },
        { path: '#', icon: 'fa fa-user', title: 'Manage users',
            roles: ['institutionadmin'],
            children: [
                { path: '/i/users/add', title: 'Add user', roles: ['institutionadmin'] },
                { path: '/i/users/list', title: 'List users', roles: ['institutionadmin'] },
            ]
        },
        { path: '#', icon: 'fa fa-users', title: 'Manage staff',
            roles: ['institutionadmin', 'user', 'staff'],
            children: [
                { path: '#', icon: 'fa fa-plus', title: 'Create staff',
                    roles: ['institutionadmin'],
                    children: [
                        { path: '/staff/add', title: 'Create staff', roles: ['institutionadmin'] },
                        { path: '/staff/list', title: 'List staff', roles: ['institutionadmin'] },
                    ]
                },
                { path: '/staff/issues', title: 'Solve staff issues', roles: ['user'] },
                { path: '/staff/manage-course', title: 'Staff course', roles: ['institutionadmin'] }
            ]
        },
        { path: '#', icon: 'fa fa-gem', title: 'Manage course',
            roles: ['institutionadmin'],
            children: [
                { path: '/i/courses', title: 'Courses', roles: ['institutionadmin'] },
                { path: '/i/course-coordinators', title: 'Course coordinators', roles: ['institutionadmin'] },
                { path: '/i/course-advisers', title: 'Course advisers', roles: ['institutionadmin'] },
                { path: '/i/course-prerequisites', title: 'Course prerequisites', roles: ['institutionadmin'] },
            ]
        },
        { path: '#', icon: 'fa fa-graduation-cap', title: 'Manage students',
            roles: ['institutionadmin', 'user', 'staff'],
            children: [
                { path: '#', title: 'Deactivate student', roles: ['institutionadmin', 'staff'] },
                { path: '#', title: 'Admit student', roles: ['institutionadmin', 'staff'] },
                { path: '#', title: 'Edit student profile', permissions: ['student:edit'] },
                { path: '#', title: 'Edit student settings', roles: ['institutionadmin', 'staff'] },
                { path: '#', title: 'Upload course reg', roles: ['user', 'staff'] },
                { path: '#', title: 'Solve student problems', roles: ['user', 'staff'] },
            ]
        },
        { path: '#', img: '/images/logo/logo-bs4.png', title: 'Manage result', permissions: [] }
    ]

    export default sidebarMenu;
</script>
