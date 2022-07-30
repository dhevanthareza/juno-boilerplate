<?php

namespace App\Modules\Role\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModel extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected $guarded = [];
}
