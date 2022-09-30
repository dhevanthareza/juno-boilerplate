<?php
namespace App\Modules\Employee\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeModel extends Model
{
    use SoftDeletes;
    protected $table = 'employee';
    protected $guarded = [];
}
