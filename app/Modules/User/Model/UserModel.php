<?php

namespace App\Modules\User\Model;

use App\Handler\ModelSearchHandler;
use App\Modules\Role\Model\RoleModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'users';
    protected $guarded = [];
    protected $appends = ['role_name_list'];


    // Scope
    public function scopeSearch($query, $keyword)
    {
        $searchable = ['name'];
        return ModelSearchHandler::handle($query, $searchable, $keyword);
    }

    // Relations
    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'user_roles', 'user_id', 'role_id')->withPivot('deleted_at')->wherePivot('deleted_at', NULL);
    }

    // Function
    protected function getRoles() {
        return $this->roles();
    }

    protected function getRoleIdsAttribute() {
        $roles = $this->roles->toArray();
        return array_map(function($role) {
            return $role['id'];
        }, $roles);
    }

    protected function getRoleNameListAttribute() {
        $role_name_list = [];
        foreach($this->roles as $role) {
            array_push($role_name_list, $role->name);
        }
        return $role_name_list;
    }
}
