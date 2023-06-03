<?php

namespace App\Modules\Shift\Models;
    
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use SoftDeletes;
    protected $table = 'shift';
    protected $guarded = [];
}