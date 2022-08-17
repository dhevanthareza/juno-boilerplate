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
        return $this->belongsToMany(RoleModel::class, 'user_roles', 'role_id', 'user_id');
    }

    // Function
    protected function getRole() {
        return $this->roles();
    }
}
