<?php

namespace App;


class AdminRole extends BaseModel
{
    protected $table = 'admin_roles';

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_permission_roles', 'role_id', 'permission_id')
            ->withPivot(['role_id', 'permission_id']);
    }

    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    public function hasPermission($permission){
        return $this->permissions->contains($permission);
    }
}
