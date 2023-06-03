<?php

namespace App\Modules\Jabatan\Models;
    
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;
    protected $table = 'jabatan';
    protected $guarded = [];
}