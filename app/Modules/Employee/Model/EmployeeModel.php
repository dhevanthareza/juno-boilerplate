<?php
namespace App\Modules\Employee\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class EmployeeModel extends Model
{
    use SoftDeletes;
    protected $table = 'employee';
    protected $guarded = [];
    protected $appends = ['photo_url'];
    
    protected function getPhotoUrlAttribute() {
        return "";
    }
}
