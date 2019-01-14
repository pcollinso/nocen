<script>
const sidebarMenu = [
  { path: '#', icon: 'fa fa-th', title: 'Create/setup institution',
    roles: ['superadmin'],
    children: [
      { path: '/institutions/add', title: 'Add institution', roles: ['superadmin'] },
      { path: '/institutions/list', title: 'List institution', roles: ['superadmin'] }
    ]
  },
  { path: '#', icon: 'fa fa-th', title: 'Manage institution admins',
    roles: ['superadmin'],
    children: [
      { path: '/institution-admins/add', title: 'Add institution admins', roles: ['superadmin'] },
      { path: '/institution-admins/list', title: 'List institution admins', roles: ['superadmin'] }
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
  { path: '#', icon: 'fa fa-hdd', title: 'Manage staff',
    roles: ['institutionadmin', 'user', 'staff'],
    children: [
      { path: '#', icon: 'fa fa-th', title: 'Create staff',
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
      { path: '#', title: 'Course adviser', roles: ['institutionadmin'] },
      { path: '#', title: 'Course coordinator', roles: ['institutionadmin'] },
      { path: '#', title: 'Course prerequisite', roles: ['institutionadmin'] },
    ]
  },
  { path: '#', icon: 'fa fa-gem', title: 'Manage users',
    roles: ['institutionadmin'],
    children: [
      { path: '#', title: 'Deactivate student', roles: ['institutionadmin'] },
      { path: '#', icon: 'fa fa-gem', title: 'Add/Edit/List',
        roles: ['institutionadmin'],
        children: [
          { path: '#', title: 'Add user', roles: ['institutionadmin'] },
          { path: '#', title: 'List users', roles: ['institutionadmin'] },
        ]
      },
    ]
  },
  { path: '#', icon: 'fa fa-gem', title: 'Manage students',
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
