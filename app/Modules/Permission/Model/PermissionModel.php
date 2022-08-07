<?php

namespace App\Modules\Permission\Model;

use App\Modules\Role\Model\RoleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModel extends Model
{
    use SoftDeletes;
    protected $table = 'permissions';
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
