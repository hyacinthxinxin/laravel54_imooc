<?php

namespace App;


class AdminPermission extends BaseModel
{
    protected $table = 'admin_permissions';

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_permission_roles', 'permission_id', 'role_id')
            ->withPivot(['permission_id', 'role_id']);
    }

}
