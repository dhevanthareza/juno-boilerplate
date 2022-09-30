<?php

namespace App\Modules\Role\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermissionModel extends Model
{
    protected $table = 'role_permissions';
    protected $guarded = [];
}
