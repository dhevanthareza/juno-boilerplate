<?php

namespace App\Modules\User\Model;

use App\Modules\Role\Model\RoleModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'users';
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'user_roles', 'user_id', 'role_id');
    }
}
