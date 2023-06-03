<?php

namespace App\Modules\Laptop\Models;
    
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laptop extends Model
{
    use SoftDeletes;
    protected $table = 'laptop';
    protected $guarded = [];
}