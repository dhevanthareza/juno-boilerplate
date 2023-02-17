<?php
namespace App\Modules\UserPref\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPref extends Model
{
    use SoftDeletes;
    protected $table = 'user_pref';
    protected $guarded = [];
}