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

    // Scope
    public function scopeSearch($query, $keyword)
    {
        $searchable = ['name'];
        return ModelSearchHandler::handle($query, $searchable, $keyword);
    }

    // Relations
    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'user_roles', 'user_id', 'role_id')->withPivot('deleted_at')->wherePivot('deleted_at', NULL);;
    }

    // Function
    protected function getRole() {
        return $this->roles();
    }
}
