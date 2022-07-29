<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use SoftDeletes;
    protected $table = 'users';
    protected $guarded = [];
}
