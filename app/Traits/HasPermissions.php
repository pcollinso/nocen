<?php
namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissions
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, $this->roles_table);
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, $this->permissions_table);
    }

    public function hasRole( ... $roles )
    {
        return (bool) $this->roles->filter(function ($r) use ($roles) {
            return in_array($r->name, $roles);
        })
        ->count();
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) /*|| $this->hasPermissionThroughRole($permission)*/;
    }

    public function hasPermission($permission)
    {
        return (bool) $this->permissions()->where('name', $permission)->count();
    }

    public function getAllPermissions(array $permissions)
    {
      return Permission::whereIn('name',$permissions)->get();
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role)
        {
            if($this->roles->contains($role))
            {
                return true;
            }
        }
        return false;
    }

    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null)
        {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function deletePermissions( ... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }
}
