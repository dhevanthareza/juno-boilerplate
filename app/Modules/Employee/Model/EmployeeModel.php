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
    protected $appends = ['photo_url', 'ktp_photo_url'];
    
    protected function getPhotoUrlAttribute() {
        return Storage::url($this->photo);
    }
    protected function getKtpPhotoUrlAttribute() {
        return "/employee/{$this->id}/ktp-photo";
    }
}
